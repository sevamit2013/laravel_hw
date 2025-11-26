<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketType::create(['name' => 'Bug']);
        TicketType::create(['name' => 'Feature Request']);
        TicketType::create(['name' => 'Support']);
    }
}
