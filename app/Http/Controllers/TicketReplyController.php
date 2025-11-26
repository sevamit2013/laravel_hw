<?php

namespace App\Http\Controllers;

use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required|exists:0_tkt_header,tkt_id',
            'description' => 'required|string',
        ]);

        TicketReply::create([
            'ticket_id' => $request->ticket_id,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tickets.show', $request->ticket_id)->with('success', 'Reply added successfully.');
    }
}
