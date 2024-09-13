<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $product1 = Product::where('name', 'Product satu')->first();
        $product2 = Product::where('name', 'Product dua')->first();
        $product3 = Product::where('name', 'Product tiga')->first();

        $member1 = User::firstWhere('username', 'member1');

        $product2Variant2 = ProductVariant::firstWhere('product_variant_name', 'variant 2');
        $product2Variant3 = ProductVariant::firstWhere('product_variant_name', 'variant 3');
        
        
        Cart::create([
            'user_id' => $member1->id,
            'product_id' => $product1->id,
            'quantity' => 1
        ]);
        
        Cart::create([
            'user_id' => $member1->id,
            'product_id' => $product2->id,
            'product_variant_id' => $product2Variant3->id,
            'quantity' => 1
        ]);
        
        Cart::create([
            'user_id' => $member1->id,
            'product_id' => $product3->id,
            'quantity' => 3
        ]);
    }
}
