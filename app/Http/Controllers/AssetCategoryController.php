<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AssetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AssetCategory::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('asset-categories.show', $row->category_id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                    $btn .= ' <a href="'.route('asset-categories.edit', $row->category_id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('asset-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asset-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'is_software' => 'boolean',
            'inactive' => 'boolean',
        ]);

        AssetCategory::create([
            'description' => $request->description,
            'is_software' => $request->has('is_software'),
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('asset-categories.index')->with('success', 'Asset category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetCategory $assetCategory)
    {
        return view('asset-categories.show', compact('assetCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetCategory $assetCategory)
    {
        return view('asset-categories.edit', compact('assetCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetCategory $assetCategory)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'is_software' => 'boolean',
            'inactive' => 'boolean',
        ]);

        $assetCategory->update([
            'description' => $request->description,
            'is_software' => $request->has('is_software'),
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('asset-categories.index')->with('success', 'Asset category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetCategory $assetCategory)
    {
        $assetCategory->delete();
        return redirect()->route('asset-categories.index')->with('success', 'Asset category deleted successfully.');
    }
}
