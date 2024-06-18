<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            LevelSeeder::class,
            NoticeSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'level_id' => 1
        ]);
        
        User::factory()->create([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'level_id' => 2
        ]);
    }
}
