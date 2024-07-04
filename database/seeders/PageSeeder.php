<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'name' => 'how_to_order', 
            'title' => 'Cara Belanja',
            'content' => 'Ini content halaman cara berbelanja'
        ]);
        
        Page::create([
            'name' => 'how_to_return', 
            'title' => 'Cara Pengembalian',
            'content' => 'Ini content halaman cara pengembalian'
        ]);
        
        Page::create([
            'name' => 'payment_method', 
            'title' => 'Metode Pembayaran',
            'content' => 'Ini content halaman metode pembayaran'
        ]);
        
        Page::create([
            'name' => 'about_us', 
            'title' => 'Tentang Kami',
            'content' => 'Ini content halaman tentang kami'
        ]);
        
        Page::create([
            'name' => 'contact', 
            'title' => 'Kontak Kami',
            'content' => 'Ini content halaman kontak kami'
        ]);
    }
}
