<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::create(['name' => 'Low']);
        Priority::create(['name' => 'Medium']);
        Priority::create(['name' => 'High']);
    }
}
