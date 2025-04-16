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
            // location core
            $table->id(); // primary key untuk location
            $table->string('name'); 
            $table->text('address')->nullable(); 
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade'); // Default is handled in Location model boot method
            $table->string('thumbnail_url')->nullable();
            $table->jsonb('operation_hours')->nullable();

            $table->timestamp('last_bump')->nullable();
            $table->unsignedInteger('likes_count')->default(0);
            $table->unsignedInteger('fav_count')->default(0);

            // location legend
            $table->boolean('is_viral')->nullable()->default(false);
            $table->boolean('is_legend')->nullable()->default(false);
            $table->boolean('is_featured')->nullable()->default(false); // Jika perlu fitur unggulan
            $table->foreignId('location_type_id')->nullable()->constrained('location_types')->onDelete('set null'); // Changed to foreignId and set null on delete

            //location point
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null'); // Changed to foreignId and set null on delete
            $table->foreignId('province_id')->nullable()->constrained('provinces')->onDelete('set null'); // Changed to foreignId and set null on delete
            $table->string('district')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('postal_code')->nullable(); 

            // location social media
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();  
            $table->string('tiktok')->nullable();   
            $table->string('youtube')->nullable();   
            $table->string('linkedin')->nullable(); 
            $table->string('facebook')->nullable();     

            // premium
            $table->dateTime('verified_until')->nullable(); // Masa berlaku verifikasi
            $table->string('verified_status')->nullable(); // status verifikasi
  

            // last_bump timestamp (nullable lebih aman daripada default 0 untuk timestamp)
            // tinyInteger cukup untuk bintang hotel (0-5)
            $table->tinyInteger('hotel_star')->unsigned()->nullable(); 

            $table->timestamps();

            // Index lain yang mungkin berguna
            // $table->index('owner_id'); // Example: Index owner_id if frequently queried
            // $table->index(['city', 'province']); // Example: Composite index
        });

        // Add the GEOGRAPHY column using a raw statement (ensure PostGIS is enabled)
        DB::statement('ALTER TABLE locations ADD COLUMN coordinate GEOGRAPHY(Point, 4326) NULL');
        
        // Now create the spatial index on the newly added column
        DB::statement('CREATE INDEX locations_coordinate_spatialindex ON locations USING GIST (coordinate)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
