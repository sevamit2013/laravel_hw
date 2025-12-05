<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = TicketType::select('type_id', 'name', 'inactive');  // ← Specify columns
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('ticket-types.show', $row->type_id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                $btn .= ' <a href="'.route('ticket-types.edit', $row->type_id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-2">Edit</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('ticket-types.index');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ticket-types.create');
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

        TicketType::create([
            'name' => $request->name,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('ticket-types.index')->with('success', 'Ticket type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketType $ticketType)
    {
        return view('ticket-types.show', compact('ticketType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketType $ticketType)
    {
        return view('ticket-types.edit', compact('ticketType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketType $ticketType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'inactive' => 'boolean',
        ]);

        $ticketType->update([
            'name' => $request->name,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('ticket-types.index')->with('success', 'Ticket type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketType $ticketType)
    {
        $ticketType->delete();
        return redirect()->route('ticket-types.index')->with('success', 'Ticket type deleted successfully.');
    }
}
