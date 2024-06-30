<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'name' => 'Arfan',
            'img' => 'mocks/me.jpg',
            'message' => 'ok mantap lorem ipsum test coba mantap ini',
            'show' => 0,
        ]); 

        Testimonial::create([
            'name' => 'Fulan',
            'img' => 'mocks/me.jpg',
            'message' => 'ok mantap lorem ipsum test coba mantap ini beli disini banyak diskon',
            'show' => 1,
        ]); 

        Testimonial::create([
            'name' => 'Fulanah',
            'img' => 'mocks/me.jpg',
            'message' => 'ok mantap lorem ipsum test coba mantap ini harga murah barang ori guys',
            'show' => 1,
        ]); 

        Testimonial::create([
            'name' => 'Abdullah',
            'img' => 'mocks/me.jpg',
            'message' => 'ok mantap lorem ipsum test coba mantap ini harga murah barang ori guys keren pokonya',
            'show' => 1,
        ]); 
        
        Testimonial::create([
            'name' => 'Abdurrahman',
            'img' => 'mocks/me.jpg',
            'message' => 'ok mantap lorem ipsum test coba mantap ini harga murah barang ori guys dijamin paling ok bergaransi',
            'show' => 1,
        ]); 
    }
}
