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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location_name')->unique();
            $table->string('campus');
            $table->string('location_address');
            $table->string('website')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->text('main_image')->nullable();
            $table->text('banner_image')->nullable();
            $table->json('carousel_images')->nullable();
            $table->string('type')->nullable();
            $table->json('cuisine');
            $table->string('price_range');
            $table->json('payment_options');
            $table->json('special_features')->nullable();
            $table->enum('approval_status', ['pending', 'approved', 'declined'])->default('pending');
            $table->enum('status', ['online', 'offline'])->default('online');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
