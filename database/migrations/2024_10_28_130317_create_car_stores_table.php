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
        Schema::create('car_stores', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_open')->default(true);
            $table->boolean('is_full')->default(false);
            $table->text('address')->nullable();
            $table->string('customer_service_name')->nullable();
            $table->string('customer_service_phone')->nullable();
            $table->string('customer_service_avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_stores');
    }
};
