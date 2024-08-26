<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userMember = User::firstWhere('username', 'member1');

        Address::create([
            'name' => 'Rumah',
            'address' => 'Jalan Beo No. 22 Karang Kemong, Cakranegara Barat, Mataram, Lombok, NTB.',
            'noteForCurrier' => 'Pas Gapura Masjid Nurul Yaqin Karang Kemong.',
            'recipient' => 'Abdullah',
            'hp' => '081907456710',
            'isMain' => true,
            'user_id' => $userMember->id,
            'area_id' => 'IDNP22IDNC271IDND2891IDZ83239',
            'area_name' => 'Cakranegara, Mataram, Nusa Tenggara Barat (NTB). 83239',
            'province' => 'Nusa Tenggara Barat (NTB)',
            'city' => 'Mataram',
            'district' => 'Cakranegara',
            'postal_code' => 83239
        ]);

        Address::create([
            'name' => 'Kantor',
            'address' => 'Jalan Caturwarga, Pajang Timur, Mataram, Lombok, NTB.',
            'noteForCurrier' => 'BBPOM di Mataram',
            'recipient' => 'Arfan',
            'hp' => '081907456710',
            'isMain' => false,
            'user_id' => $userMember->id,
            'area_id' => 'IDNP22IDNC271IDND2892IDZ83117',
            'area_name' => 'Mataram, Mataram, Nusa Tenggara Barat (NTB). 83117',
            'province' => 'Nusa Tenggara Barat (NTB)',
            'city' => 'Mataram',
            'district' => 'Mataram',
            'postal_code' => 83117
        ]);
    }
}
