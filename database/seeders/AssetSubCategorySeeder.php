<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssetSubCategory;
use App\Models\AssetCategory;

class AssetSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hardware = AssetCategory::where('description', 'Hardware')->first();
        $software = AssetCategory::where('description', 'Software')->first();
        $networking = AssetCategory::where('description', 'Networking')->first();

        if ($hardware) {
            AssetSubCategory::create(['asset_category_id' => $hardware->category_id, 'description' => 'Laptop']);
            AssetSubCategory::create(['asset_category_id' => $hardware->category_id, 'description' => 'Desktop']);
            AssetSubCategory::create(['asset_category_id' => $hardware->category_id, 'description' => 'Printer']);
        }

        if ($software) {
            AssetSubCategory::create(['asset_category_id' => $software->category_id, 'description' => 'Operating System']);
            AssetSubCategory::create(['asset_category_id' => $software->category_id, 'description' => 'Office Suite']);
        }

        if ($networking) {
            AssetSubCategory::create(['asset_category_id' => $networking->category_id, 'description' => 'Router']);
            AssetSubCategory::create(['asset_category_id' => $networking->category_id, 'description' => 'Switch']);
        }
    }
}