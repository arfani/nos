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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('product_id')->constrained()->cascadeOnDelete();
            $table->boolean('active')->default(true);
            $table->timestamp('endtime')->default(now()->addDays(1));
            $table->float('bid_start')->unsigned()->nullable()->default(0);
            $table->float('bid_increment')->unsigned()->nullable()->default(0);
            $table->longText('rules')->nullable();
            // $table->unsignedBigInteger('winner')->nullable()->default(null);
            $table->foreignUuid('winner')->nullable()->default(null)->references('id')->on('users')->noActionOnDelete();
            $table->float('bid_winner')->unsigned()->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
