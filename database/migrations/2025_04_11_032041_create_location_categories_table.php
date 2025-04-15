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
        Schema::create('location_categories', function (Blueprint $table) {
            $table->id(); // category_id
            $table->string('name')->unique(); // category name
            $table->text('svg_icon')->nullable(); // category svg icon (text untuk data panjang)
            $table->string('slug')->unique(); // category slug
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_categories');
    }
};
