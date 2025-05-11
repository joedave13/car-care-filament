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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('phone', 20);
            $table->foreignId('car_store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_service_id')->constrained()->cascadeOnDelete();
            $table->date('started_date');
            $table->time('started_time');
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('booking_fee')->default(0);
            $table->unsignedBigInteger('vat')->default(0);
            $table->unsignedBigInteger('grand_total')->default(0);
            $table->string('payment_status')->default('pending');
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
