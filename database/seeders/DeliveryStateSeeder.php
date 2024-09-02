<?php

namespace Database\Seeders;

use App\Models\DeliveryState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryState::create([
            "id" => 1,
            "name" => "Menunggu Konfirmasi"
        ]);

        DeliveryState::create([
            "id" => 2,
            "name" => "Diproses"
        ]);

        DeliveryState::create([
            "id" => 3,
            "name" => "Dikirim"
        ]);

        DeliveryState::create([
            "id" => 4,
            "name" => "Selesai"
        ]);

    }
}
