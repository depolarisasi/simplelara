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
        Schema::create('location_sub_categories', function (Blueprint $table) {
            $table->id(); // subcategory_id
            $table->string('name')->unique(); // subcategory name
            $table->text('svg_icon')->nullable(); // subcategory svg icon
            $table->string('slug')->unique(); // subcategory slug
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_sub_categories');
    }
};
