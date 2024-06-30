<?php

namespace Database\Seeders;

use App\Models\Sosmed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SosmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sosmed::create([
            'name' => 'Tokopedia',
            'logo' => 'mocks/tokopedia.png',
            'url' => '#'
        ]); 
        Sosmed::create([
            'name' => 'Shopee',
            'logo' => 'mocks/shopee.png',
            'url' => '#'
        ]); 
        Sosmed::create([
            'name' => 'Blibli',
            'logo' => 'mocks/blibli.png',
            'url' => '#'
        ]); 
    }
}
