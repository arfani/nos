<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $product1 = Product::where('slug', 'Product-satu')->first();
        $product2 = Product::where('slug', 'Product-dua')->first();
        $product3 = Product::where('slug', 'Product-tiga')->first();
        $product4 = Product::where('slug', 'Product-empat')->first();
        $product5 = Product::where('slug', 'Product-lima')->first();
        $product6 = Product::where('slug', 'Product-enam')->first();
        $product7 = Product::where('slug', 'Product-tujuh')->first();
        $product8 = Product::where('slug', 'Product-delapan')->first();
        $product9 = Product::where('slug', 'Product-sembilan')->first();
        $product10 = Product::where('slug', 'Product-sepuluh')->first();

        CategoryProduct::create([
            'product_id' => $product1->id,
            'category_id' => 1,
        ]);
        
        CategoryProduct::create([
            'product_id' => $product2->id,
            'category_id' =>2,
        ]);
        
        CategoryProduct::create([
            'product_id' => $product3->id,
            'category_id' => 3,
        ]);
        
        CategoryProduct::create([
            'product_id' => $product4->id,
            'category_id' => 1,
        ]);
        CategoryProduct::create([
            'product_id' => $product5->id,
            'category_id' => 1,
        ]);
        CategoryProduct::create([
            'product_id' => $product6->id,
            'category_id' => 1,
        ]);
        CategoryProduct::create([
            'product_id' => $product7->id,
            'category_id' => 1,
        ]);
        CategoryProduct::create([
            'product_id' => $product8->id,
            'category_id' => 2,
        ]);
        CategoryProduct::create([
            'product_id' => $product9->id,
            'category_id' => 2,
        ]);
        CategoryProduct::create([
            'product_id' => $product10->id,
            'category_id' => 2,
        ]);
    }
}
