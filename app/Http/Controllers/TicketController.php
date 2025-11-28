<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assembly;
use App\Models\Location;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ticket::with(['ticket_status', 'priority', 'createdBy'])->select('0_tkt_header.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function($row){
                    return $row->title;
                })
                ->addColumn('status', function($row){
                    return $row->ticket_status ? $row->ticket_status->name : '';
                })
                ->addColumn('priority', function($row){
                    return $row->priority ? $row->priority->name : '';
                })
                ->addColumn('created_by', function($row){
                    return $row->createdBy instanceof \App\Models\User ? $row->createdBy->name : '';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('tickets.show', $row->tkt_id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                    $btn .= ' <a href="'.route('tickets.edit', $row->tkt_id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $priorities = Priority::all();
        $ticketTypes = TicketType::all();
        $users = User::all();
        $locations = Location::all();
        $assets = Asset::all();
        $assemblies = Assembly::all();
        return view('tickets.create', compact('priorities', 'ticketTypes', 'users', 'locations', 'assets', 'assemblies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
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
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'seeker_name' => $request->seeker_name,
            'priority_id' => $request->priority_id,
            'type_id' => $request->ticket_type_id,
            'assign_id' => $request->assigned_to,
            'status_id' => TicketStatus::where('name', 'Open')->first()->id,
            'due_date' => $request->due_date,
            'created_by' => Auth::id(),
            'modified_by' => Auth::id(),
            'loc_code' => $request->location_id,
            'asset_id' => $request->asset_id,
            'assembly_id' => $request->assembly_id,
        ]);

        Log::info('Ticket created with ID: ' . $ticket->tkt_id);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['priority', 'ticket_type', 'assignedTo', 'createdBy', 'ticket_status', 'location', 'asset', 'assembly', 'replies.user']);
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $priorities = Priority::all();
        $ticketTypes = TicketType::all();
        $users = User::all();
        $ticketStatuses = TicketStatus::all();
        $locations = Location::all();
        $assets = Asset::all();
        $assemblies = Assembly::all();
        return view('tickets.edit', compact('ticket', 'priorities', 'ticketTypes', 'users', 'ticketStatuses', 'locations', 'assets', 'assemblies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority_id' => 'required|exists:priorities,id',
            'ticket_type_id' => 'required|exists:0_tkt_types,type_id',
            'assigned_to' => 'nullable|exists:0_users,id',
            'ticket_status_id' => 'required|exists:ticket_statuses,id',
            'due_date' => 'required|date',
            'location_id' => 'required|exists:0_seva_locations,loc_code',
            'asset_id' => 'nullable|exists:0_hw_assets,asset_id',
            'assembly_id' => 'nullable|exists:0_hw_assembly,assembly_id',
        ]);

        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority_id' => $request->priority_id,
            'type_id' => $request->ticket_type_id,
            'assign_id' => $request->assigned_to,
            'status_id' => $request->ticket_status_id,
            'due_date' => $request->due_date,
            'loc_code' => $request->location_id,
            'modified_by' => Auth::id(),
            'asset_id' => $request->asset_id,
            'assembly_id' => $request->assembly_id,
        ]);

        return redirect()->route('tickets.show', $ticket->tkt_id)->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}