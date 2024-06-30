<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Feature::create([
            'name' => 'Support CS',
        ]);
        
        Feature::create([
            'name' => 'Free Ongkir wilayah Jakarta',
        ]);
        
        Feature::create([
            'name' => 'Barang Original',
        ]);
        
        Feature::create([
            'name' => 'Bergaransi',
        ]);
    }
}
