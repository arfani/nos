<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * TABEL INI DIGUNAKAN UNTUK DATA ADDRESS YANG DIGUNAKAN DI ORDER AGAR SAAT DATA ADDRESS DIUBAH OLEH USER MAKA DATA HISTORY NYA TIDAK BERUBAH
     */
    public function up(): void
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('address');
            $table->text('noteForCurrier')->nullable();
            $table->string('recipient', 100);
            $table->string('hp', 100);
            $table->boolean('isMain')->default(false);
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->string('area_id');
            $table->string('area_name');
            $table->string('postal_code');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
