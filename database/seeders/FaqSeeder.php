<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'question' => 'Apa saja yg dijual disini ?',
            'answer' => 'Produk networking seperti kabel UTP, Access Point, Router, dsb.'
        ]);

        Faq::create([
            'question' => 'Bagaimana Cara memesan ?',
            'answer' => 'Silahkan pilih product lalu checkout dan ikuti step-stepnya. Silahkan hubungi kami melalui halaman contact untuk bantuan lebih lanjut.'
        ]);

        Faq::create([
            'question' => 'Mengapa harga barang tidak tampil ?',
            'answer' => 'Silahkan login dulu untuk melihat harga barang, atau daftar jika Anda belum memiliki akun.'
        ]);
    }
}
