<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Identity;

class IdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Identity::insert([
            ['name' => 'Emma Rodriguez', 'email' => 'emma.rodriguez@heroic.com'],
            ['name' => 'Alex Turner', 'email' => 'alex.turner@heroic.com'],
            ['name' => 'David Kim', 'email' => 'david.kim@heroic.com'],
        ]);
    }
}
