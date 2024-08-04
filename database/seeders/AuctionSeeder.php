<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product1 = Product::where('name', 'Product satu')->first();
        $product2 = Product::where('name', 'Product dua')->first();
        $product3 = Product::where('name', 'Product tiga')->first();

        Auction::create([
            'product_id' => $product1->id,
            'active' => true,
            'endtime' => now()->addDays(1),
            'bid_start' => 20000,
            'bid_increment' => 5000,
            'rules' => 'syarat dan ketentuan berlaku',
        ]);

        Auction::create([
            'product_id' => $product2->id,
            'active' => true,
            'endtime' => now()->addDays(2),
            'bid_start' => 10000,
            'bid_increment' => 10000,
            'rules' => 'syarat dan ketentuan berlaku',
            'winner' => 2,
            'bid_winner' => 710000,
        ]);
        
        Auction::create([
            'product_id' => $product3->id,
            'active' => true,
            'endtime' => now()->addDays(3),
            'bid_start' => 200000,
            'bid_increment' => 50000,
            'rules' => 'pemenang silahkan menghubungi admin untuk konfirmasi ongkir dan alamat',
        ]);
    }
}
