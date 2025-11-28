<?php

namespace App\Http\Controllers;

use App\Models\Assembly;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AssemblyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Assembly::with(['location', 'user'])->select('0_hw_assembly.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('assembly_code', function($row){
                    return $row->assembly_code;
                })
                ->addColumn('description', function($row){
                    return $row->description;
                })
                ->addColumn('location', function($row){
                    return $row->location ? $row->location->location_name : '';
                })
                ->addColumn('user', function($row){
                    return $row->user instanceof \App\Models\User ? $row->user->name : '';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('assemblies.show', $row->assembly_id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                    $btn .= ' <a href="'.route('assemblies.edit', $row->assembly_id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('assemblies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $users = User::all();
        return view('assemblies.create', compact('locations', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'assembly_code' => 'required|string|max:255',
        'description'   => 'nullable|string',
        'ip_address'    => 'nullable|string|max:45',
        'loc_code'   => 'required|exists:0_seva_locations,loc_code',
        'remark'        => 'nullable|string',
        'status'        => 'required|integer',
    ]);

    // Fix missing / empty IP
    if (empty($validated['ip_address'])) {
        $validated['ip_address'] = $request->ip() ?? '0.0.0.0';
    }

    // System fields auto-filled
    $validated['created_by'] = auth()->id();
    $validated['modified_by'] = auth()->id();
    $validated['user_id']     = auth()->id();

    \App\Models\Assembly::create($validated);

    return redirect()
        ->route('assemblies.index')
        ->with('success', 'Assembly created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Assembly $assembly)
    {
        $assembly->load(['location', 'user']);
        return view('assemblies.show', compact('assembly'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assembly $assembly)
    {
        $locations = Location::all();
        $users = User::all();
        return view('assemblies.edit', compact('assembly', 'locations', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assembly $assembly)
    {
        $request->validate([
            'assembly_code' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'ip_address' => 'nullable|ip',
            'loc_code' => 'required|exists:0_seva_locations,loc_code',
            'user_id' => 'nullable|exists:0_users,id',
            'remark' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        $assembly->update([
            'assembly_code' => $request->assembly_code,
            'description' => $request->description,
            'ip_address' => $request->ip_address,
            'loc_code' => $request->loc_code,
            'user_id' => $request->user_id,
            'remark' => $request->remark,
            'status' => $request->status,
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('assemblies.index')->with('success', 'Assembly updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assembly $assembly)
    {
        $assembly->delete();
        return redirect()->route('assemblies.index')->with('success', 'Assembly deleted successfully.');
    }
}
