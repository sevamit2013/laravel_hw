<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssetCategory;

class AssetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetCategory::create(['description' => 'Hardware']);
        AssetCategory::create(['description' => 'Software']);
        AssetCategory::create(['description' => 'Networking']);
    }
}