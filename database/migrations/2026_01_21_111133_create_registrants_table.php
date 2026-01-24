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
        // 1. Tabel Master Siswa (Data Siswa Sekolah)
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique(); // Kunci utama identifikasi
            $table->string('nama_siswa');
            $table->string('kelas');
            $table->timestamps();
        });

        // 2. Tabel Transaksi Pendaftaran (Pivot Siswa <-> Ekskul)
        Schema::create('ekskul_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->foreignId('ekskul_id')->constrained('ekskuls')->onDelete('cascade');
            $table->string('no_wa'); // No WA disimpan saat mendaftar ekskul
            $table->timestamps();

            // Mencegah duplikasi: 1 Siswa hanya bisa 1x daftar di Ekskul yang sama
            $table->unique(['siswa_id', 'ekskul_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekskul_siswa');
        Schema::dropIfExists('siswas');
    }
};
