<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use App\Models\AssetSubCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AssetSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AssetSubCategory::with('category')->select('0_hw_sub_category.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function($row){
                    return $row->category->description;
                })
                ->addColumn('action', function($row){
                    // Pass the $row object (or its key) directly to the route helper
                    $btn = '<a href="'.route('asset-sub-categories.show', $row).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                    $btn .= ' <a href="'.route('asset-sub-categories.edit', $row).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('asset-sub-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assetCategories = AssetCategory::all();
        // The variable $assetCategories is fine in camelCase
        return view('asset-sub-categories.create', compact('assetCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'asset_category_id' => 'required|exists:0_hw_stock_category,category_id',
            'inactive' => 'boolean',
        ]);

        AssetSubCategory::create([
            'description' => $request->description,
            'asset_category_id' => $request->asset_category_id,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('asset-sub-categories.index')->with('success', 'Asset sub category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetSubCategory $assetSubCategory)
    {
        $assetSubCategory->load('category');
        // 👇 CHANGED: Renamed variable to snake_case for consistency with common Blade practice
        $asset_sub_category = $assetSubCategory; 
        return view('asset-sub-categories.show', compact('asset_sub_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetSubCategory $assetSubCategory)
    {
        $assetCategories = AssetCategory::all();
        // 👇 CHANGED: Renamed variable to snake_case for consistency with common Blade practice
        $asset_sub_category = $assetSubCategory; 
        return view('asset-sub-categories.edit', compact('asset_sub_category', 'assetCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetSubCategory $assetSubCategory)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'asset_category_id' => 'required|exists:0_hw_stock_category,category_id',
            'inactive' => 'boolean',
        ]);

        $assetSubCategory->update([
            'description' => $request->description,
            'asset_category_id' => $request->asset_category_id,
            'inactive' => $request->has('inactive'),
        ]);

        return redirect()->route('asset-sub-categories.index')->with('success', 'Asset sub category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetSubCategory $assetSubCategory)
    {
        $assetSubCategory->delete();
        return redirect()->route('asset-sub-categories.index')->with('success', 'Asset sub category deleted successfully.');
    }
}