<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekskul;

class EkskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekskuls = [
            [
                'nama' => 'Basket',
                'deskripsi' => 'Ekstrakurikuler bola basket untuk melatih ketangkasan dan kerjasama tim.',
                'gambar' => null,
                'icon' => '🏀', // Emoji Basket
                'warna' => '#ea580c', // Orange
                'penanggung_jawab' => 'Budi Santoso',
                'hari' => 'Senin',
                'jam_mulai' => '15:30',
                'jam_selesai' => '17:30',
            ],
            [
                'nama' => 'Futsal',
                'deskripsi' => 'Wadah pengembangan bakat sepak bola mini bagi siswa.',
                'gambar' => null,
                'icon' => '⚽', // Emoji Bola Sepak
                'warna' => '#16a34a', // Hijau
                'penanggung_jawab' => 'Rahmat Hidayat',
                'hari' => 'Rabu',
                'jam_mulai' => '16:00',
                'jam_selesai' => '18:00',
            ],
            [
                'nama' => 'Pramuka',
                'deskripsi' => 'Kegiatan kepanduan wajib untuk membentuk karakter disiplin dan mandiri.',
                'gambar' => null,
                'icon' => '⚜️', // Emoji Fleur-de-lis (Simbol Pramuka)
                'warna' => '#854d0e', // Coklat
                'penanggung_jawab' => 'Siti Aminah',
                'hari' => 'Jumat',
                'jam_mulai' => '13:00',
                'jam_selesai' => '15:00',
            ],
            [
                'nama' => 'English Club',
                'deskripsi' => 'Komunitas belajar bahasa Inggris yang asik dan interaktif.',
                'gambar' => null,
                'icon' => '🗣️', // Emoji Orang Berbicara
                'warna' => '#2563eb', // Biru
                'penanggung_jawab' => 'Ms. Jessica',
                'hari' => 'Selasa',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:00',
            ],
            [
                'nama' => 'PMR (Palang Merah Remaja)',
                'deskripsi' => 'Membangun jiwa kemanusiaan dan keterampilan pertolongan pertama.',
                'gambar' => null,
                'icon' => '⛑️', // Emoji Helm Penyelamat
                'warna' => '#dc2626', // Merah
                'penanggung_jawab' => 'Dr. Andi',
                'hari' => 'Kamis',
                'jam_mulai' => '15:00',
                'jam_selesai' => '17:00',
            ],
        ];

        foreach ($ekskuls as $data) {
            Ekskul::create($data);
        }
    }
}
