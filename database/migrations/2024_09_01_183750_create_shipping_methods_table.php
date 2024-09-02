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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->json('available_collection_method')->nullable();
            $table->boolean('available_for_cash_on_delivery');
            $table->boolean('available_for_proof_of_delivery');
            $table->boolean('available_for_instant_waybill_id');
            $table->boolean('available_for_insurance');
            $table->string('company');
            $table->string('courier_name');
            $table->string('courier_code');
            $table->string('courier_service_name');
            $table->string('courier_service_code');
            $table->text('description')->nullable();
            $table->string('duration');
            $table->string('shipment_duration_range');
            $table->string('shipment_duration_unit');
            $table->string('service_type');
            $table->string('shipping_type');
            $table->unsignedBigInteger('price');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
