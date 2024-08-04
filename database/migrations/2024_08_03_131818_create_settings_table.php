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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('section_name', 100); //ini menjadi key
            $table->boolean('is_show')->default(true);
            $table->string('title', 100);
            $table->text('description')->nullable()->default(null);
            $table->tinyInteger('show_items')->nullable()->default(0); // untuk pengaturan maximal item pada section yang memiliki tampilan gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
