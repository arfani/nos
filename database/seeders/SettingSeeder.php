<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'section_name' => 'hero',
            'is_show' => true,
            'title' => 'Barang Bergaransi !',
            'description' => 'Kualitas tinggi dengan garansi seumur hidup Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus alias est voluptate rerum dolorem ad culpa quos, voluptates itaque reiciendis maxime eum, odit deleniti in at ratione asperiores iste facere.',
            'show_items' => 10
        ]);
        
        Setting::create([
            'section_name' => 'promo',
            'is_show' => true,
            'title' => 'PROMO RAMADHAN !!',
            'description' => 'Jangan lewatkan promo ramadhan tahun ini !! Buruan cekidot',
            'show_items' => 10
        ]);
        
        Setting::create([
            'section_name' => 'auction',
            'is_show' => true,
            'title' => 'DILELANG !!',
            'description' => 'Segera checkout barang-barang yang kami lelang sebelum terlambat !! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis rerum, cumque quidem nam mollitia aperiam suscipit voluptatem fugit earum ipsa ducimus provident excepturi ullam ipsum unde ratione, dolore voluptates non?',
            'show_items' => 10
        ]);
        
        Setting::create([
            'section_name' => 'product',
            'is_show' => true,
            'title' => 'PRODUK TERBARU !!',
            'description' => 'Jangan ketinggalan, cek produk terbaru kami sekarang !!',
            'show_items' => 10
        ]);
        
        Setting::create([
            'section_name' => 'testimonial',
            'is_show' => true,
            'title' => 'KATA PELANGGAN',
            'description' => '',
            'show_items' => 10
        ]);
        
        Setting::create([
            'section_name' => 'faq',
            'is_show' => true,
            'title' => 'FAQ',
            'description' => 'Sebelum bertanya baca ini dulu ya.',
            'show_items' => 10
        ]);
        
        Setting::create([
            'section_name' => 'brand',
            'is_show' => true,
            'title' => 'BRAND TERBAIK KAMI',
            'description' => 'Klik pada logo untuk mengunjungi official website masing-masing brand',
            'show_items' => 10
        ]);
    }
}
