<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::with('parent')->select('0_seva_locations.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('parent_location', function($row){
                    return $row->parent ? $row->parent->location_name : '';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('locations.show', $row->loc_code).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                    $btn .= ' <a href="'.route('locations.edit', $row->loc_code).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('locations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        return view('locations.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'loc_code' => 'required|string|max:255|unique:0_seva_locations,loc_code',
            'location_name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:0_seva_locations,loc_code',
            'inactive' => 'boolean',
        ]);

        Location::create([
            'loc_code' => $request->loc_code,
            'location_name' => $request->location_name,
            'parent_id' => $request->parent_id,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        $location->load('parent');
        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        $locations = Location::all();
        return view('locations.edit', compact('location', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
{
    // We don't really want to change loc_code (it's the primary key like ROOT),
    // so we only validate it for presence + uniqueness against other rows.
    $validated = $request->validate([
        'loc_code' => [
            'required',
            'string',
            'max:255',
            Rule::unique('0_seva_locations', 'loc_code')
                ->ignore($location->loc_code, 'loc_code'), // <-- IMPORTANT: ignore by loc_code, not id
        ],
        'location_name' => ['required', 'string', 'max:255'],
        'parent_id'     => ['nullable'],   // you can tighten this later if needed
        'inactive'      => ['nullable'],
    ]);

    // Since loc_code is PK and we made it readonly in the form, you can choose:
    // (A) keep existing loc_code and not update it:
    // $location->loc_code stays as is
    //
    // or (B) allow changing it by uncommenting the line below.
    // For safety, I'll keep it unchanged here.

    $location->update([
        // 'loc_code'      => $validated['loc_code'], // <-- enable if you really want to allow changing it
        'location_name' => $validated['location_name'],
        'parent_id'     => $validated['parent_id'] ?? null,
        'inactive'      => $request->boolean('inactive'),
    ]);

    return redirect()
        ->route('locations.index')
        ->with('success', 'Location updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
