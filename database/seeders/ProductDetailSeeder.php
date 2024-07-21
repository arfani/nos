<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductDetail::create([
            'product_variant_id' => 2,
            'variant_value_id' => 1
        ]);
        
        ProductDetail::create([
            'product_variant_id' => 2,
            'variant_value_id' => 4
        ]);
        
        ProductDetail::create([
            'product_variant_id' => 3,
            'variant_value_id' => 2
        ]);

        ProductDetail::create([
            'product_variant_id' => 3,
            'variant_value_id' => 5
        ]);
        
        ProductDetail::create([
            'product_variant_id' => 4,
            'variant_value_id' => 3
        ]);
        
        ProductDetail::create([
            'product_variant_id' => 4,
            'variant_value_id' => 4
        ]);
    }
}
