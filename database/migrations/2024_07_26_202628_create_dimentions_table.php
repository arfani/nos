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
        Schema::create('dimentions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('product_id')->constrained()->onDelete('cascade');
            $table->integer('length')->unsigned()->nullable()->default(0);
            $table->integer('width')->unsigned()->nullable()->default(0);
            $table->integer('height')->unsigned()->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dimentions');
    }
};
