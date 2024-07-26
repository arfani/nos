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
        $product1 = Product::where('name', 'Product satu')->first();
        $product2 = Product::where('name', 'Product dua')->first();
        $product5 = Product::where('name', 'Product lima')->first();

        Promo::create([
            'product_id' => $product1->id,
            'discount' => 10,
            'active' => true,
        ]);

        Promo::create([
            'product_id' => $product2->id,
            'discount' => 20,
            'active' => true,
        ]);

        Promo::create([
            'product_id' => $product5->id,
            'discount' => 50,
            'active' => true,
        ]);
    }
}
