<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {
            //TABEL INI BELUM DIGUNAKAN KARENA LANGSUNG FETCH DARI BITESHIP
            // $table->string('id')->primary();
            // $table->string('name');
            // $table->string('country_name');
            // $table->string('country_code');
            // $table->string('administrative_division_level_1_name');
            // $table->string('administrative_division_level_1_type');
            // $table->string('administrative_division_level_2_name');
            // $table->string('administrative_division_level_2_type');
            // $table->string('administrative_division_level_3_name');
            // $table->string('administrative_division_level_3_type');
            // $table->integer('postal_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
