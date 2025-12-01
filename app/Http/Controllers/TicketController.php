<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assembly;
use App\Models\Location;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\TicketAttachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            
            // Base query with eager loading
            $query = Ticket::with(['ticket_status', 'priority', 'createdBy', 'assignedTo', 'location'])
                ->select('0_tkt_header.*');
            
            // Filter based on role
            if (!$user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin'])) {
                $query->where('created_by', $user->id);
            }
            
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('title', function($row){
                    $badge = '';
                    if ($row->unread_count > 0) {
                        $badge = '<span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">' . $row->unread_count . ' new</span>';
                    }
                    return $row->title . $badge;
                })
                ->addColumn('status', function($row){
                    $colors = [
                        'Open' => 'bg-green-100 text-green-800',
                        'In Progress' => 'bg-blue-100 text-blue-800',
                        'Closed' => 'bg-gray-100 text-gray-800',
                        'Pending' => 'bg-yellow-100 text-yellow-800',
                    ];
                    $color = $colors[$row->ticket_status->name] ?? 'bg-gray-100 text-gray-800';
                    return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ' . $color . '">' . 
                           $row->ticket_status->name . '</span>';
                })
                ->addColumn('priority', function($row){
                    $colors = [
                        'Low' => 'text-green-600',
                        'Medium' => 'text-yellow-600',
                        'High' => 'text-red-600',
                    ];
                    $color = $colors[$row->priority->name] ?? 'text-gray-600';
                    return '<span class="' . $color . ' font-medium">' . $row->priority->name . '</span>';
                })
                ->addColumn('department', function($row){
                    return $row->location ? $row->location->location_name : '';
                })
                ->addColumn('assigned_to', function($row){
                    return $row->assignedTo ? $row->assignedTo->name : '<span class="text-gray-400">Unassigned</span>';
                })
                ->addColumn('created_by', function($row){
                    return $row->createdBy instanceof \App\Models\User ? $row->createdBy->name : '';
                })
                ->addColumn('due_date', function($row){
                    $dueDate = $row->due_date->format('M d, Y');
                    if ($row->isLate()) {
                        return '<span class="text-red-600 font-medium">' . $dueDate . ' (Late)</span>';
                    }
                    return $dueDate;
                })
                ->addColumn('action', function($row){
            $user = auth()->user();

            $btn = '<a href="'.route('tickets.show', $row->tkt_id).'" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">View</a>';

            if ($user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin']) || $row->created_by == $user->id) {
                $btn .= ' <a href="'.route('tickets.edit', $row->tkt_id).'" class="inline-flex items-center px-3 py-1.5 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-2">Edit</a>';
            }

            // Add Reply button
            $btn .= ' <a href="'.route('tickets.show', $row->tkt_id).'#replies" class="inline-flex items-center px-3 py-1.5 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-2">Reply</a>';

            // Add Reopen button if ticket is closed
            if ($row->is_closed && $user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin'])) {
                $btn .= ' <form action="'.route('tickets.reopen', $row->tkt_id).'" method="POST" class="inline ml-2">
                            '.csrf_field().'
                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">Reopen</button>
                        </form>';
            }
            
            return $btn;
        })
                ->filterColumn('title', function($query, $keyword) {
                    $query->where('title', 'like', "%{$keyword}%");
                })
                ->filterColumn('status', function($query, $keyword) {
                    $query->whereHas('ticket_status', function($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->filterColumn('department', function($query, $keyword) {
                    $query->whereHas('location', function($q) use ($keyword) {
                        $q->where('location_name', 'like', "%{$keyword}%");
                    });
                })
                ->rawColumns(['title', 'status', 'priority', 'assigned_to', 'due_date', 'action'])
                ->make(true);
        }

        return view('tickets.index');
    }

    public function create()
{
    // Get all necessary data for the form
    $priorities = Priority::all();
    $ticketTypes = TicketType::all();
    $locations = Location::all();
    $assets = Asset::all();
    $assemblies = Assembly::all();
    
    // Get users who can be assigned tickets (admins only)
    $users = User::whereHas('roles', function($q) {
        $q->whereIn('slug', ['hw-admin', 'hw-subadmin', 'superadmin']);
    })->get();
    
    return view('tickets.create', compact(
        'priorities',
        'ticketTypes',
        'locations',
        'assets',
        'assemblies',
        'users'
    ));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority_id' => 'required|exists:priorities,id',
            'ticket_type_id' => 'required|exists:0_tkt_types,type_id',
            'assigned_to' => 'nullable|exists:0_users,id',
            'seeker_name' => 'required|string|max:255',
            'due_date' => 'required|date',
            'location_id' => 'required|exists:0_seva_locations,loc_code',
            'asset_id' => 'nullable|exists:0_hw_assets,asset_id',
            'assembly_id' => 'nullable|exists:0_hw_assembly,assembly_id',
            'expected_time_hours' => 'nullable|integer|min:0',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:5120', // 5MB max
        ]);

        $ticket = Ticket::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'seeker_name' => $validated['seeker_name'],
            'priority_id' => $validated['priority_id'],
            'type_id' => $validated['ticket_type_id'],
            'assign_id' => $validated['assigned_to'] ?? null,
            'status_id' => TicketStatus::where('name', 'Open')->first()->id,
            'due_date' => $validated['due_date'],
            'expected_time_hours' => $validated['expected_time_hours'] ?? null,
            'created_by' => Auth::id(),
            'modified_by' => Auth::id(),
            'loc_code' => $validated['location_id'],
            'asset_id' => $validated['asset_id'] ?? null,
            'assembly_id' => $validated['assembly_id'] ?? null,
        ]);

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('ticket_attachments', $filename, 'public');
                
                TicketAttachment::create([
                    'ticket_id' => $ticket->tkt_id,
                    'filename' => $filename,
                    'original_filename' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'path' => $path,
                    'uploaded_by' => Auth::id(),
                ]);
            }
        }

        // Send notification via ntfy.sh
        $this->sendNotification($ticket, 'new_ticket');

        Log::info('Ticket created with ID: ' . $ticket->tkt_id);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show($tkt_id)
    {
        $ticket = Ticket::findOrFail($tkt_id);
        // Check access
        $user = auth()->user();
        if (!$user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin']) && $ticket->created_by != $user->id) {
            abort(403, 'Unauthorized access to this ticket.');
        }

        // Reset unread count for ticket creator
        if ($ticket->created_by == $user->id) {
            $ticket->resetUnreadCount();
        }

        $ticket->load([
            'priority', 
            'ticket_type', 
            'assignedTo', 
            'createdBy', 
            'ticket_status', 
            'location', 
            'asset', 
            'assembly', 
            'replies.user',
            'replies.attachments',
            'attachments'
        ]);
        
        return view('tickets.show', compact('ticket'));
    }

public function edit($tkt_id)
{
    $ticket = Ticket::findOrFail($tkt_id);
    // Check access
    $user = auth()->user();
    if (!$user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin']) && $ticket->created_by != $user->id) {
        abort(403, 'Unauthorized access to edit this ticket.');
    }

    // Get all necessary data for the form
    $priorities = Priority::all();
    $ticketTypes = TicketType::all();
    $ticketStatuses = TicketStatus::all();
    $locations = Location::all();
    $assets = Asset::all();
    $assemblies = Assembly::all();
    
    // Get users who can be assigned tickets (admins only)
    $users = User::whereHas('roles', function($q) {
        $q->whereIn('slug', ['hw-admin', 'hw-subadmin', 'superadmin']);
    })->get();
    
    return view('tickets.edit', compact(
        'ticket',
        'priorities',
        'ticketTypes',
        'ticketStatuses',
        'locations',
        'assets',
        'assemblies',
        'users'
    ));
}

public function update(Request $request, $tkt_id)
{
    $ticket = Ticket::findOrFail($tkt_id);
    // Check access
    $user = auth()->user();
    if (!$user->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin']) && $ticket->created_by != $user->id) {
        abort(403, 'Unauthorized access to edit this ticket.');
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'priority_id' => 'required|exists:priorities,id',
        'ticket_type_id' => 'required|exists:0_tkt_types,type_id',
        'status_id' => 'required|exists:0_tkt_status,id',
        'assigned_to' => 'nullable|exists:0_users,id',
        'seeker_name' => 'required|string|max:255',
        'due_date' => 'required|date',
        'location_id' => 'required|exists:0_seva_locations,loc_code',
        'asset_id' => 'nullable|exists:0_hw_assets,asset_id',
        'assembly_id' => 'nullable|exists:0_hw_assembly,assembly_id',
        'expected_time_hours' => 'nullable|integer|min:0',
        'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:5120',
    ]);

    $oldAssignedTo = $ticket->assign_id;

    $ticket->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'seeker_name' => $validated['seeker_name'],
        'priority_id' => $validated['priority_id'],
        'type_id' => $validated['ticket_type_id'],
        'status_id' => $validated['status_id'],
        'assign_id' => $validated['assigned_to'] ?? null,
        'due_date' => $validated['due_date'],
        'expected_time_hours' => $validated['expected_time_hours'] ?? null,
        'modified_by' => Auth::id(),
        'loc_code' => $validated['location_id'],
        'asset_id' => $validated['asset_id'] ?? null,
        'assembly_id' => $validated['assembly_id'] ?? null,
    ]);

    // Handle file uploads
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('ticket_attachments', $filename, 'public');
            
            TicketAttachment::create([
                'ticket_id' => $ticket->tkt_id,
                'filename' => $filename,
                'original_filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'path' => $path,
                'uploaded_by' => Auth::id(),
            ]);
        }
    }

    // Send notification if assigned to someone new
    if ($oldAssignedTo != $ticket->assign_id && $ticket->assign_id) {
        $this->sendNotification($ticket, 'ticket_assigned');
    }

  // Go back to tickets list
return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');

// Stay on edit page with success message
return redirect()->back()->with('success', 'Ticket updated successfully.');
}


    public function reopen($tkt_id)
    {
        $ticket = Ticket::findOrFail($tkt_id);
        // Only hw-admin, hw-subadmin, or superadmin can reopen tickets
        if (!auth()->user()->hasAnyRole(['hw-admin', 'hw-subadmin', 'superadmin'])) {
            abort(403, 'Unauthorized action.');
        }

        $ticket->update([
            'is_closed' => false,
            'is_reopen' => true,
            'status_id' => TicketStatus::where('name', 'Open')->first()->id,
            'modified_by' => Auth::id(),
        ]);

        // Send notification
        $this->sendNotification($ticket, 'ticket_reopened');

        return redirect()->route('tickets.index')->with('success', 'Ticket reopened successfully.');
    }

    private function sendNotification($ticket, $event)
    {
        // Implement ntfy.sh notification
        $ntfyUrl = env('NTFY_URL', 'https://ntfy.sh');
        $topic = env('NTFY_TOPIC', 'hardware_tickets');
        
        $messages = [
            'new_ticket' => "New Ticket #{$ticket->tkt_id}: {$ticket->title}",
            'new_reply' => "New reply on Ticket #{$ticket->tkt_id}",
            'ticket_reopened' => "Ticket #{$ticket->tkt_id} has been reopened",
            'ticket_assigned' => "Ticket #{$ticket->tkt_id} has been assigned to you",
        ];
        
        $message = $messages[$event] ?? "Ticket #{$ticket->tkt_id} updated";
        
        try {
            $ch = curl_init("{$ntfyUrl}/{$topic}");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Title: Hardware Ticket System',
                'Priority: default',
                'Tags: ticket,hardware'
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $e) {
            Log::error('Ntfy notification failed: ' . $e->getMessage());
        }
    }
}