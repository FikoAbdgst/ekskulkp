<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ekskuls', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();

            // Kolom Baru
            $table->string('icon')->default('bi-stars'); // Menyimpan class icon (contoh: bi-basket)
            $table->string('warna')->default('#6366f1'); // Menyimpan kode hex warna
            $table->string('hari'); // Contoh: Senin
            $table->time('jam_mulai'); // Contoh: 15:00
            $table->time('jam_selesai'); // Contoh: 17:00

            // Kolom 'jadwal' dihapus karena sudah dipecah

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekskuls');
    }
};
