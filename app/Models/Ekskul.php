<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'icon',
        'warna',
        'penanggung_jawab',
        'hari',
        'jam_mulai',
        'jam_selesai'
    ];

    // Relasi ke Siswa (Many to Many)
    public function siswas()
    {
        return $this->belongsToMany(Siswa::class)
            ->withPivot('alasan', 'no_wa') // <--- PENTING: Agar field ini terbaca
            ->withTimestamps();
    }
}
