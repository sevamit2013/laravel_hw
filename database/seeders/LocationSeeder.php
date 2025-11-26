<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rootLocation = Location::create([
            'loc_code' => 'ROOT',
            'location_name' => 'Root Location',
            'inactive' => false,
        ]);

        Location::create([
            'loc_code' => 'CHILD1',
            'location_name' => 'Child Location 1',
            'parent_id' => $rootLocation->id,
            'inactive' => false,
        ]);
    }
}
