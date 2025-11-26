<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketStatus::create(['name' => 'Open']);
        TicketStatus::create(['name' => 'In Progress']);
        TicketStatus::create(['name' => 'Closed']);
    }
}
