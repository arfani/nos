<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Product satu',
            'slug' => 'product_satu',
            'stock' => 100,
            'price' => 100000,
        ]);
        
        Product::create([
            'name' => 'Product dua',
            'slug' => 'product_dua',
            'stock' => 200,
            'price' => 200000,
        ]);
        
        Product::create([
            'name' => 'Product tiga',
            'slug' => 'product_tiga',
            'stock' => 300,
            'price' => 300000,
        ]);
        
        Product::create([
            'name' => 'Product empat',
            'slug' => 'product_empat',
            'stock' => 400,
            'price' => 400000,
        ]);
        
        Product::create([
            'name' => 'Product lima',
            'slug' => 'product_lima',
            'stock' => 500,
            'price' => 500000,
        ]);
    }
}
