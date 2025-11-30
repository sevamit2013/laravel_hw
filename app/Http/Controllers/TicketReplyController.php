<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\TicketAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TicketReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:0_tkt_header,tkt_id',
            'description' => 'required|string',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:5120',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $user = auth()->user();

        // Check access
        if (!$user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin']) && $ticket->created_by != $user->id && $ticket->assign_id != $user->id) {
            abort(403, 'You are not authorized to reply to this ticket.');
        }

        // Mark previous replies as read if user is the ticket creator
        if ($ticket->created_by == $user->id) {
            TicketReply::where('ticket_id', $ticket->tkt_id)
                ->where('user_id', '!=', $user->id)
                ->update(['unread' => false]);
        }

        // Create reply
        $reply = TicketReply::create([
            'ticket_id' => $request->ticket_id,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'unread' => true, // Mark as unread for the recipient
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('reply_attachments', $filename, 'public');
                
                TicketAttachment::create([
                    'ticket_id' => $ticket->tkt_id,
                    'reply_id' => $reply->id,
                    'filename' => $filename,
                    'original_filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'path' => $path,
                    'uploaded_by' => Auth::id(),
                ]);
            }
        }

        // Increment unread count for ticket creator if reply is from someone else
        if ($ticket->created_by != $user->id) {
            $ticket->incrementUnreadCount();
        }

        // Send notification
        $this->sendReplyNotification($ticket, $reply);

        return redirect()->route('tickets.show', $request->ticket_id)
            ->with('success', 'Reply posted successfully.');
    }

    private function sendReplyNotification($ticket, $reply)
    {
        $ntfyUrl = env('NTFY_URL', 'https://ntfy.sh');
        $topic = env('NTFY_TOPIC', 'hardware_tickets');
        
        $userName = $reply->user->name;
        $message = "New reply from {$userName} on Ticket #{$ticket->tkt_id}: {$ticket->title}";
        
        // Determine who should receive the notification
        $notifyUsers = [];
        
        // Notify ticket creator if reply is not from them
        if ($ticket->created_by != $reply->user_id) {
            $notifyUsers[] = $ticket->createdBy;
        }
        
        // Notify assigned user if reply is not from them
        if ($ticket->assign_id && $ticket->assign_id != $reply->user_id) {
            $notifyUsers[] = $ticket->assignedTo;
        }
        
        // Notify all hw-admin, hw-subadmin, superadmin users except the reply author
        if ($reply->user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin'])) {
            // If reply is from admin, notify the ticket creator
            $notifyUsers[] = $ticket->createdBy;
        } else {
            // If reply is from user, notify all admins
            $adminUsers = \App\Models\User::whereHas('roles', function($q) {
                $q->whereIn('slug', ['hw-admin', 'hw-subadmin', 'superadmin']);
            })->where('id', '!=', $reply->user_id)->get();
            
            $notifyUsers = array_merge($notifyUsers, $adminUsers->all());
        }
        
        // Remove duplicates
        $notifyUsers = collect($notifyUsers)->unique('id');
        
        try {
            // Send notification via ntfy.sh
            $ch = curl_init("{$ntfyUrl}/{$topic}");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Title: New Ticket Reply',
                'Priority: default',
                'Tags: ticket,reply,notification',
                'Click: ' . route('tickets.show', $ticket->tkt_id)
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            
            Log::info('Reply notification sent', [
                'ticket_id' => $ticket->tkt_id,
                'reply_id' => $reply->id,
                'recipients' => $notifyUsers->pluck('name')->implode(', ')
            ]);
        } catch (\Exception $e) {
            Log::error('Ntfy reply notification failed: ' . $e->getMessage());
        }
    }
}