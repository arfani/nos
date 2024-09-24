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
            'slug' => 'product-satu',
            'description' => 'Description of Product satu'
        ]);
        
        Product::create([
            'name' => 'Product dua',
            'slug' => 'product-dua',
            'description' => 'Description of Product dua'
        ]);
        
        Product::create([
            'name' => 'Product tiga',
            'slug' => 'product-tiga',
            'description' => 'Description of Product tiga'
        ]);
        
        Product::create([
            'name' => 'Product empat',
            'slug' => 'product-empat',
            'description' => 'Description of Product empat'
        ]);
        
        Product::create([
            'name' => 'Product lima',
            'slug' => 'product-lima',
            'description' => 'Description of Product lima'
        ]);

        Product::create([
            'name' => 'Product enam',
            'slug' => 'product-enam',
            'description' => 'Description of Product enam'
        ]);

        Product::create([
            'name' => 'Product tujuh',
            'slug' => 'product-tujuh',
            'description' => 'Description of Product tujuh'
        ]);
        
        Product::create([
            'name' => 'Product delapan',
            'slug' => 'product-delapan',
            'description' => 'Description of Product delapan'
        ]);
        
        Product::create([
            'name' => 'Product sembilan',
            'slug' => 'product-sembilan',
            'description' => 'Description of Product sembilan'
        ]);

        Product::create([
            'name' => 'Product sepuluh',
            'slug' => 'product-sepuluh',
            'description' => 'Description of Product sepuluh'
        ]);
    }
}
