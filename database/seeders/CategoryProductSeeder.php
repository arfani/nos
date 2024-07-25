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
        $product1 = Product::where('name', 'Product satu')->first();
        $product2 = Product::where('name', 'Product dua')->first();
        $product3 = Product::where('name', 'Product tiga')->first();
        $product4 = Product::where('name', 'Product empat')->first();
        $product5 = Product::where('name', 'Product lima')->first();

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
    }
}
