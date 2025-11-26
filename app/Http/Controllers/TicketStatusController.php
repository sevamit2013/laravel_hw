<?php

namespace App\Http\Controllers;

use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TicketStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TicketStatus::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('ticket-statuses.show', $row->id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                    $btn .= ' <a href="'.route('ticket-statuses.edit', $row->id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('ticket-statuses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket-statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'inactive' => 'boolean',
        ]);

        TicketStatus::create([
            'name' => $request->name,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('ticket-statuses.index')->with('success', 'Ticket status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketStatus $ticketStatus)
    {
        return view('ticket-statuses.show', compact('ticketStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketStatus $ticketStatus)
    {
        return view('ticket-statuses.edit', compact('ticketStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketStatus $ticketStatus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'inactive' => 'boolean',
        ]);

        $ticketStatus->update([
            'name' => $request->name,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('ticket-statuses.index')->with('success', 'Ticket status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketStatus $ticketStatus)
    {
        $ticketStatus->delete();
        return redirect()->route('ticket-statuses.index')->with('success', 'Ticket status deleted successfully.');
    }
}
