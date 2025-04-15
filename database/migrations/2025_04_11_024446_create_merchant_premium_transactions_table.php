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

            // Relasi ke lokasi mana yang di-premiumkan
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');

            // Relasi ke paket premium yang dipilih
            // onDelete('restrict') atau nullOnDelete() mungkin lebih baik agar histori tidak hilang jika plan dihapus
            $table->foreignId('premium_plan_id')->constrained('premium_plans')->onDelete('restrict');

            $table->timestamp('start_date'); // premium_start_date
            $table->timestamp('end_date'); // premium_end_date

            // Tambahkan kolom status transaksi jika perlu (misal: pending, success, failed)
            // $table->string('status')->default('pending');
            // Tambahkan kolom detail pembayaran jika perlu (misal: payment_gateway_id, transaction_code)

            $table->timestamps();

            $table->index('location_id');
            $table->index('premium_plan_id');
        });

        // Jika ingin membuat relasi dari locations ke transaction (untuk 'merchant_verify')
        // Anda perlu menambahkan kolom foreign key di tabel 'locations' (bisa nullable).
        // Ini bisa dilakukan di migrasi 'locations' atau migrasi terpisah SETELAH ini.
        // Contoh (jika ditambahkan di migrasi terpisah):
        // Schema::table('locations', function (Blueprint $table) {
        //     $table->foreignId('merchant_premium_transaction_id')->nullable()->constrained('merchant_premium_transactions')->nullOnDelete();
        // });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_premium_transactions');
    }
};
