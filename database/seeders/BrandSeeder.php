<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Apple',
            'logo' => '/mocks/brands/apple.webp',
            'link' => '#'
        ]);
        
        Brand::create([
            'name' => 'Asus',
            'logo' => '/mocks/brands/asus.webp',
            'link' => '#'
        ]);
        
        Brand::create([
            'name' => 'LG',
            'logo' => '/mocks/brands/lg.webp',
            'link' => '#'
        ]);
        
        Brand::create([
            'name' => 'DELL',
            'logo' => '/mocks/brands/dell.webp',
            'link' => '#'
        ]);
        
        Brand::create([
            'name' => 'Samsung',
            'logo' => '/mocks/brands/samsung.webp',
            'link' => '#'
        ]);
        
        Brand::create([
            'name' => 'Toshiba',
            'logo' => '/mocks/brands/toshiba.webp',
            'link' => '#'
        ]);
        
        Brand::create([
            'name' => 'Xiaomi',
            'logo' => '/mocks/brands/xiaomi.webp',
            'link' => '#'
        ]); 
        
        Brand::create([
            'name' => 'HP',
            'logo' => '/mocks/brands/hp.webp',
            'link' => '#'
        ]);
        
        Brand::create([
            'name' => 'Sony',
            'logo' => '/mocks/brands/sony.webp',
            'link' => '#'
        ]);
    }
}
