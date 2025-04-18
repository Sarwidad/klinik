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
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade'); // Relasi dengan tabel pasiens
            $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade'); // Relasi dengan tabel pegawais
            $table->date('tanggal_periksa');
            $table->text('keluhan');
            $table->text('diagnosa');
            $table->text('catatan')->nullable(); // Catatan tambahan bisa kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
