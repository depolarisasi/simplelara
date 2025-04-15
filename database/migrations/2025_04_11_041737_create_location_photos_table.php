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
        Schema::create('location_photos', function (Blueprint $table) {
            $table->id();
                $table->string('url'); // photos_url
                // Foreign key ke tabel locations (galeri foto milik suatu lokasi)
                $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
                // Anda bisa menambahkan kolom lain seperti 'order' atau 'caption' jika perlu
                // $table->integer('order')->default(0);
                // $table->string('caption')->nullable();
                $table->timestamps();
    
                $table->index('location_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_photos');
    }
};
