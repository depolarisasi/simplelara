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
        Schema::create('premium_plans', function (Blueprint $table) {
            $table->id(); // plan_id
            $table->string('name')->unique(); // plan_name
            // Gunakan decimal untuk harga agar presisi
            $table->decimal('price', 15, 0)->default(0); // plan_price (contoh: 15 digit total, 2 di belakang koma)
            $table->integer('duration_days')->default(0); // plan_premium_duration (misal dalam hari)
            $table->string('thumbnail')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premium_plans');
    }
};
