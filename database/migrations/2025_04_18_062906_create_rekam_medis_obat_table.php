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
        Schema::create('rekam_medis_obat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekam_medis_id')->constrained()->onDelete('cascade');
            $table->foreignId('obat_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis_obat');
    }
};
