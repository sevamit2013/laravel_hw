<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\AssetSubCategory;
use App\Models\Assembly;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Asset::with(['category', 'subCategory', 'location', 'user', 'assembly'])->select('0_hw_assets.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('asset_code', function($row){
                    return $row->asset_code;
                })
                ->addColumn('category', function($row){
                    return $row->category ? $row->category->description : '';
                })
                ->addColumn('location', function($row){
                    return $row->location ? $row->location->location_name : '';
                })
                ->addColumn('user', function($row){
                    return $row->user instanceof \App\Models\User ? $row->user->name : '';
                })
                ->addColumn('assembly', function($row){
                    return $row->assembly ? $row->assembly->assembly_code : '';
                })
                ->addColumn('manufacturer', function($row){
                    return $row->manufacturer;
                })
                ->addColumn('status', function($row){
                    return $row->status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('assets.show', $row->id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">View</a>';
                    $btn .= ' <a href="'.route('assets.edit', $row->id).'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('assets.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assetCategories = AssetCategory::all();
        $assetSubCategories = AssetSubCategory::all();
        $locations = Location::all();
        $users = User::all();
        $assemblies = Assembly::all();
        return view('assets.create', compact('assetCategories', 'assetSubCategories', 'locations', 'users', 'assemblies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset_code' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'asset_category_id' => 'required|exists:0_hw_stock_category,category_id',
            'asset_sub_category_id' => 'required|exists:0_hw_sub_category,sub_cat_id',
            'location_id' => 'required|exists:0_seva_locations,loc_code',
            'user_id' => 'nullable|exists:0_users,id',
            'assembly_id' => 'nullable|exists:0_hw_assembly,assembly_id',
            'manufacturer' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'company_serial' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric',
            'warranty_expiration_date' => 'nullable|date',
            'remark' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        Asset::create([
            'asset_code' => $request->asset_code,
            'description' => $request->description,
            'asset_category_id' => $request->asset_category_id,
            'asset_sub_category_id' => $request->asset_sub_category_id,
            'location_id' => $request->location_id,
            'user' => $request->user_id,
            'assembly_id' => $request->assembly_id,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'company_serial' => $request->company_serial,
            'purchase_date' => $request->purchase_date,
            'purchase_cost' => $request->purchase_cost,
            'warranty_expiration_date' => $request->warranty_expiration_date,
            'remark' => $request->remark,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        $asset->load(['category', 'subCategory', 'location', 'user', 'assembly']);
        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        $assetCategories = AssetCategory::all();
        $assetSubCategories = AssetSubCategory::all();
        $locations = Location::all();
        $users = User::all();
        $assemblies = Assembly::all();
        return view('assets.edit', compact('asset', 'assetCategories', 'assetSubCategories', 'locations', 'users', 'assemblies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'asset_code' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'asset_category_id' => 'required|exists:0_hw_stock_category,category_id',
            'asset_sub_category_id' => 'required|exists:0_hw_sub_category,sub_cat_id',
            'location_id' => 'required|exists:0_seva_locations,loc_code',
            'user_id' => 'nullable|exists:0_users,id',
            'assembly_id' => 'nullable|exists:0_hw_assembly,assembly_id',
            'manufacturer' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'company_serial' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric',
            'warranty_expiration_date' => 'nullable|date',
            'remark' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        $asset->update([
            'asset_code' => $request->asset_code,
            'description' => $request->description,
            'asset_category_id' => $request->asset_category_id,
            'asset_sub_category_id' => $request->asset_sub_category_id,
            'location_id' => $request->location_id,
            'user' => $request->user_id,
            'assembly_id' => $request->assembly_id,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'company_serial' => $request->company_serial,
            'purchase_date' => $request->purchase_date,
            'purchase_cost' => $request->purchase_cost,
            'warranty_expiration_date' => $request->warranty_expiration_date,
            'remark' => $request->remark,
            'status' => $request->status,
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
