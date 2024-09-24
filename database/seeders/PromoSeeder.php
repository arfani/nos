<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Promo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product5 = Product::where('slug', 'Product-lima')->first();
        $product6 = Product::where('slug', 'Product-enam')->first();
        $product7 = Product::where('slug', 'Product-tujuh')->first();
        $product8 = Product::where('slug', 'Product-delapan')->first();
        $product9 = Product::where('slug', 'Product-sembilan')->first();
        $product10 = Product::where('slug', 'Product-sepuluh')->first();

        Promo::create([
            'product_id' => $product5->id,
            'discount' => 20,
            'active' => true,
        ]);

        Promo::create([
            'product_id' => $product6->id,
            'discount' => 50,
            'active' => true,
        ]);

        Promo::create([
            'product_id' => $product7->id,
            'discount' => 25,
            'active' => true,
        ]);

        Promo::create([
            'product_id' => $product8->id,
            'discount' => 50,
            'active' => true,
        ]);

        Promo::create([
            'product_id' => $product9->id,
            'discount' => 25,
            'active' => true,
        ]);

        Promo::create([
            'product_id' => $product10->id,
            'discount' => 50,
            'active' => true,
        ]);
    }
}
