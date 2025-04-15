<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; //
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable();  
            $table->string('phone')->nullable();
            $table->enum('role', ['merchant', 'user', 'admin'])->default('user');
            $table->timestamp('last_login')->nullable();  
            $table->string('avatar_url')->nullable(); 
        });
        
        DB::statement('ALTER TABLE users ADD COLUMN last_location GEOGRAPHY(Point, 4326) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'phone', 'role', 'last_login', 'avatar_url']);
        });
        
        DB::statement('ALTER TABLE users DROP COLUMN IF EXISTS last_location');
    }
};
