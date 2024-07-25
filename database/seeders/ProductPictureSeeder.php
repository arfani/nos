<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPicture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductPictureSeeder extends Seeder
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

        ProductPicture::create([
            'product_id' => $product1->id,
            'path' => '/mocks/a.jpg',
        ]);
        
        ProductPicture::create([
            'product_id' => $product2->id,
            'path' => '/mocks/b.jpg',
        ]);
        
        ProductPicture::create([
            'product_id' => $product3->id,
            'path' => '/mocks/c.jpg',
        ]);
        
        ProductPicture::create([
            'product_id' => $product4->id,
            'path' => '/mocks/d.jpg',
        ]);
        
        ProductPicture::create([
            'product_id' => $product5->id,
            'path' => '/mocks/e.jpg',
        ]);
    }
}
