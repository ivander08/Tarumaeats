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
            $table->string('username')->default("testUser");
            $table->string('location_name');
            $table->string('location_address');
            $table->string('price_range');
            $table->string('website')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('images')->nullable();
            $table->json('tags')->nullable();
            $table->json('special_features')->nullable();
            $table->string('price_per_person')->nullable();
            $table->json('payment_options')->nullable();
            $table->string('open_hours')->nullable();
            $table->string('closed_hours')->nullable();
            $table->enum('approval_status', ['pending', 'approved', 'declined'])->default('pending');
            $table->enum('status', ['online', 'offline'])->default('online');
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
