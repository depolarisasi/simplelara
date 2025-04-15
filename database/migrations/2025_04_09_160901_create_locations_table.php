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
        Schema::create('locations', function (Blueprint $table) {
            $table->id(); // primary key untuk location
            $table->string('name');
            $table->string('telp')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();  
            $table->string('tiktok')->nullable();  
            // Koordinat utama lokasi, sebaiknya tidak nullable
            $table->geography('coordinate', 'point');
            // Relasi Many-to-Many 'category' dan 'subcategory' akan dibuat via pivot table
            $table->text('operation_hours')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail_url')->nullable();

            // Relasi ke user (merchant)
            $table->foreignId('merchant_id')->constrained('users')->onDelete('cascade');

            $table->enum('merchant_status', ['non verified', 'bronze verified', 'silver verified', 'gold verified'])->default('non verified');
            $table->string('merchant_email')->nullable(); // Email khusus merchant jika berbeda
            $table->foreignId('merchant_premium_transaction_id')->nullable()->constrained('merchant_premium_transactions')->nullOnDelete();
 

            $table->boolean('merchant_islegend')->nullable()->default(false);
            $table->boolean('merchant_isviral')->nullable()->default(false);
            $table->enum('merchant_type', ['UMKM', 'NON UMKM']);
            $table->in('city')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('province')->nullable();
            // last_bump timestamp (nullable lebih aman daripada default 0 untuk timestamp)
            $table->timestamp('last_bump')->nullable();
            $table->unsignedInteger('likes_count')->default(0);
            $table->unsignedInteger('fav_count')->default(0);
            // tinyInteger cukup untuk bintang hotel (0-5)
            $table->tinyInteger('hotel_star')->unsigned()->nullable(); 

            $table->timestamps();

            // Index untuk pencarian spasial (PostGIS)
            $table->spatialIndex('coordinate');
            // Index lain yang mungkin berguna 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
