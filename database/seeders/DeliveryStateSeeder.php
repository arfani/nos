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
        $states = [
        1 => "Menunggu Pembayaran",
        2 => "Menunggu Konfirmasi",
        3 => "Diproses",
        4 => "Dikirim",
        5 => "Selesai",
        6 => "Dibatalkan",
    ];

    foreach ($states as $id => $name) {
        DeliveryState::updateOrCreate(
            ['id' => $id],        // cari berdasarkan ID fix
            ['name' => $name]     // kalau ada update name, kalau belum ada create
        );
    }
    }
}
