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
        Schema::create('merchant_premium_transactions', function (Blueprint $table) {
            $table->id(); // premium_id (primary key transaksi)

            $table->string('transaction_code')->nullable()->unique();
            // Relasi ke lokasi mana yang di-premiumkan
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('merchant_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('premium_plan_id')->constrained('premium_plans')->onDelete('restrict');

            $table->string('payment_method')->nullable();   
            $table->decimal('tax', 15, 0)->nullable()->default(0); 
            $table->decimal('fee', 15, 0)->nullable()->default(0); 
            $table->decimal('amount', 15, 0)->default(0); 

            $table->string('status')->nullable()->default('pending');

            $table->timestamp('start_date'); // premium_start_date
            $table->timestamp('end_date'); // premium_end_date

            // Tambahkan kolom status transaksi jika perlu (misal: pending, success, failed)
            // $table->string('status')->default('pending');
            // Tambahkan kolom detail pembayaran jika perlu (misal: payment_gateway_id, transaction_code)

            $table->timestamps();

            $table->index('location_id');
            $table->index('premium_plan_id');
        });
 
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_premium_transactions');
    }
};
