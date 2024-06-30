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
            FaqSeeder::class,
            BrandSeeder::class,
            FeatureSeeder::class,
            SosmedSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'hp' => '081907123123',
            'img' => 'mocks/me.jpg',
            'fullname' => 'Administrator bin Fulan',
            'birthday' => now(),
            'gender' => 'm',
            'status-pernikahan' => 'menikah',  
            'status' => 'living life',
            'occupation' => 'Pengusaha',
            'education' => 'S1',
            'level_id' => 1
        ]);
        
        User::factory()->create([
            'name' => 'Member',
            'email' => 'member@example.com',
            'hp' => '081907123123',
            'img' => 'mocks/me.jpg',
            'fullname' => 'Member bin Fulan',
            'birthday' => now(),
            'gender' => 'm',
            'status-pernikahan' => 'menikah',  
            'status' => 'living life',
            'occupation' => 'Pengusaha',
            'education' => 'S1',
            'level_id' => 2
        ]);
    }
}
