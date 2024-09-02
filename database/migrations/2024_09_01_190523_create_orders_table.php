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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id');
            $table->string('invoice');
            // $table->string('notes');
            $table->float('tax')->unsigned()->nullable()->default(null);
            $table->enum('payment_method', ['Cash', 'Transfer'])->default('Transfer');
            $table->float('total')->unsigned();
            $table->boolean('is_paid')->default(false);
            $table->string('bukti_pembayaran')->nullable()->default(null);
            $table->foreignId('delivery_state_id')->default(1)->constrained()->restrictOnDelete(); //status tidak boleh dihapus
            $table->foreignId('order_address_id')->constrained()->restrictOnDelete(); 
            $table->foreignId('shipping_method_id')->constrained()->restrictOnDelete(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
