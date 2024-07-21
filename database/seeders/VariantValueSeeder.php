<?php

namespace Database\Seeders;

use App\Models\VariantValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VariantValue::create([
            'variant_id' => 1,
            'value' => 'Merah'
        ]);
        VariantValue::create([
            'variant_id' => 1,
            'value' => 'Putih'
        ]);
        VariantValue::create([
            'variant_id' => 1,
            'value' => 'Biru'
        ]);
        VariantValue::create([
            'variant_id' => 2,
            'value' => 'M'
        ]);
        VariantValue::create([
            'variant_id' => 2,
            'value' => 'L'
        ]);
    }
}
