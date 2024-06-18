<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            'id' => 1,
            'name' => 'Admin',
        ]);
        
        Level::create([
            'id' => 2,
            'name' => 'Member',
        ]);
    }
}
