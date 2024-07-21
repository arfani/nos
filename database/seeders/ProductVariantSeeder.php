<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
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

        ProductVariant::create([
            'product_id' => $product1->id,
            'product_variant_name' => null,
            'sku' => 'prosatuori',
            'price' => 100000,
            'stock' => 100,
            'weight' => 500, //gram
            'active' => true
        ]);

        ProductVariant::create([
            'product_id' => $product2->id,
            'product_variant_name' => 'variant 1',
            'sku' => 'produav1',
            'price' => 200000,
            'stock' => 200,
            'weight' => 500, //gram
            'active' => true
        ]);
        
        ProductVariant::create([
            'product_id' => $product2->id,
            'product_variant_name' => 'variant 2',
            'sku' => 'produav2',
            'price' => 210000,
            'stock' => 200,
            'weight' => 500, //gram
            'active' => true
        ]);
        
        ProductVariant::create([
            'product_id' => $product2->id,
            'product_variant_name' => 'variant 3',
            'sku' => 'produav3',
            'price' => 220000,
            'stock' => 200,
            'weight' => 500, //gram
            'active' => true
        ]);
        
        ProductVariant::create([
            'product_id' => $product3->id,
            'product_variant_name' => null,
            'sku' => 'protigaori',
            'price' => 300000,
            'stock' => 300,
            'weight' => 1000, //gram
            'active' => true
        ]);
        
        ProductVariant::create([
            'product_id' => $product4->id,
            'product_variant_name' => null,
            'sku' => 'proempatori',
            'price' => 400000,
            'stock' => 400,
            'weight' => 500, //gram
            'active' => true
        ]);
        
        ProductVariant::create([
            'product_id' => $product5->id,
            'product_variant_name' => null,
            'sku' => 'prolimaori',
            'price' => 500000,
            'stock' => 500,
            'weight' => 500, //gram
            'active' => true
        ]);
    }
}
