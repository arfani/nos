<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            NoticeSeeder::class,
            FaqSeeder::class,
            BrandSeeder::class,
            FeatureSeeder::class,
            SosmedSeeder::class,
            TestimonialSeeder::class,
            PageSeeder::class,
            CategorySeeder::class,
            AddressSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            VariantSeeder::class,
            VariantValueSeeder::class,
            ProductDetailSeeder::class,
            CategoryProductSeeder::class,
            ProductPictureSeeder::class,
            PromoSeeder::class,
        ]);
    }
}
