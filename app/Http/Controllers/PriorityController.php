<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Priority::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('priorities.show', $row->id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                    $btn .= ' <a href="'.route('priorities.edit', $row->id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('priorities.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('priorities.create');
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

        Priority::create([
            'name' => $request->name,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('priorities.index')->with('success', 'Priority created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Priority $priority)
    {
        return view('priorities.show', compact('priority'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Priority $priority)
    {
        return view('priorities.edit', compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Priority $priority)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'inactive' => 'boolean',
        ]);

        $priority->update([
            'name' => $request->name,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('priorities.index')->with('success', 'Priority updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Priority $priority)
    {
        $priority->delete();
        return redirect()->route('priorities.index')->with('success', 'Priority deleted successfully.');
    }
}
