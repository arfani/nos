<?php

namespace Database\Seeders;

use App\Models\Dimention;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DimentionSeeder extends Seeder
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

        Dimention::create([
            'product_id' => $product1->id,
            'length' => 10,
            'width' => 10,
            'height' => 10
        ]);

        Dimention::create([
            'product_id' => $product2->id,
            'length' => 20,
            'width' => 20,
            'height' => 20
        ]);

        Dimention::create([
            'product_id' => $product3->id,
            'length' => 30,
            'width' => 30,
            'height' => 30
        ]);

        Dimention::create([
            'product_id' => $product4->id,
            'length' => 40,
            'width' => 40,
            'height' => 40
        ]);

        Dimention::create([
            'product_id' => $product5->id,
            'length' => 50,
            'width' => 50,
            'height' => 50
        ]);
    }
}
