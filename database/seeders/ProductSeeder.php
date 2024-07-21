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
            'description' => 'Description of Product satu'
        ]);
        
        Product::create([
            'name' => 'Product dua',
            'slug' => 'product_dua',
            'description' => 'Description of Product dua'
        ]);
        
        Product::create([
            'name' => 'Product tiga',
            'slug' => 'product_tiga',
            'description' => 'Description of Product tiga'
        ]);
        
        Product::create([
            'name' => 'Product empat',
            'slug' => 'product_empat',
            'description' => 'Description of Product empat'
        ]);
        
        Product::create([
            'name' => 'Product lima',
            'slug' => 'product_lima',
            'description' => 'Description of Product lima'
        ]);
    }
}
