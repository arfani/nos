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

        ProductPicture::create([
            'product_id' => $product6->id,
            'path' => '/mocks/c.jpg',
        ]);

        ProductPicture::create([
            'product_id' => $product7->id,
            'path' => '/mocks/a.jpg',
        ]);
        ProductPicture::create([
            'product_id' => $product8->id,
            'path' => '/mocks/b.jpg',
        ]);
        ProductPicture::create([
            'product_id' => $product9->id,
            'path' => '/mocks/e.jpg',
        ]);
        ProductPicture::create([
            'product_id' => $product10->id,
            'path' => '/mocks/d.jpg',
        ]);
    }
}
