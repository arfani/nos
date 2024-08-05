<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin1',
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
            'username' => 'member1',
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

        User::factory()->create([
            'name' => 'Member 2',
            'username' => 'member2',
            'email' => 'member2@example.com',
            'hp' => '081907123123',
            'img' => 'mocks/me.jpg',
            'fullname' => 'Member 2 bin Fulan',
            'birthday' => now(),
            'gender' => 'm',
            'status-pernikahan' => 'menikah',  
            'status' => 'living life',
            'occupation' => 'Pengusaha',
            'education' => 'S1',
            'level_id' => 2
        ]);

        User::factory()->create([
            'name' => 'Member 3',
            'username' => 'member3',
            'email' => 'member3@example.com',
            'hp' => '081907123123',
            'img' => 'mocks/me.jpg',
            'fullname' => 'Member 3 bin Fulan',
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
