<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'name' => 'Rumah',
            'address' => 'Jalan Beo No. 22 Karang Kemong, Cakranegara Barat, Mataram, Lombok, NTB.',
            'noteForCurrier' => 'Pas Gapura Masjid Nurul Yaqin Karang Kemong.',
            'recipient' => 'Abdullah',
            'hp' => '081907456710',
            'isMain' => true,
            'user_id' => 2,
        ]);
        
        Address::create([
            'name' => 'Kantor',
            'address' => 'Jalan Caturwarga, Pajang Timur, Mataram, Lombok, NTB.',
            'noteForCurrier' => 'BBPOM di Mataram',
            'recipient' => 'Arfan',
            'hp' => '081907456710',
            'isMain' => false,
            'user_id' => 2,
        ]);
    }
}
