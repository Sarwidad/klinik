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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_medis_id')->constrained('rekam_medis')->onDelete('cascade'); // Relasi dengan rekam medis
            $table->date('tanggal_tagihan');
            $table->enum('status_pembayaran', ['belum_bayar', 'lunas']); // Status pembayaran (belum bayar atau lunas)
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'kredit']); // Metode pembayaran
            $table->decimal('total_tagihan', 10, 2); // Total tagihan yang dihitung
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
