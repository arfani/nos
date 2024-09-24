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
            'product_id' => $product2->id,
            'product_variant_name' => 'variant 4',
            'sku' => 'produav4',
            'price' => 250000,
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

        ProductVariant::create([
            'product_id' => $product6->id,
            'product_variant_name' => null,
            'sku' => 'proenamori',
            'price' => 500000,
            'stock' => 600,
            'weight' => 500, //gram
            'active' => true
        ]);

        ProductVariant::create([
            'product_id' => $product7->id,
            'product_variant_name' => null,
            'sku' => 'protujuhori',
            'price' => 500000,
            'stock' => 700,
            'weight' => 500, //gram
            'active' => true
        ]);

        ProductVariant::create([
            'product_id' => $product8->id,
            'product_variant_name' => null,
            'sku' => 'prodelapanori',
            'price' => 500000,
            'stock' => 500,
            'weight' => 500, //gram
            'active' => true
        ]);

        ProductVariant::create([
            'product_id' => $product9->id,
            'product_variant_name' => null,
            'sku' => 'prosembilanori',
            'price' => 500000,
            'stock' => 500,
            'weight' => 500, //gram
            'active' => true
        ]);

        ProductVariant::create([
            'product_id' => $product10->id,
            'product_variant_name' => null,
            'sku' => 'prosepuluhori',
            'price' => 500000,
            'stock' => 500,
            'weight' => 500, //gram
            'active' => true
        ]);
    }
}
