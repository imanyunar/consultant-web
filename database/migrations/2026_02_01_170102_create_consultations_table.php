<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('consultations', function (Blueprint $table) {
        $table->id();
        $table->string('nama_umkm');
        $table->string('bidang_usaha');
        $table->string('nomor_wa');
        $table->text('keluhan_utama');
        $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
