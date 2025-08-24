<?php

namespace Database\Seeders;

use App\Models\CategoryLabel;
use Illuminate\Database\Seeder;

class CategoryLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryLabel::create(['id' => 1, 'name' => 'Lainnya']);
    }
}
