<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama_siswa', 'nisn', 'kelas'];

    /**
     * 1. Mutator: Otomatis ubah kelas jadi HURUF BESAR saat disimpan.
     * (Mengatasi masalah input user huruf kecil)
     */
    public function setKelasAttribute($value)
    {
        $this->attributes['kelas'] = strtoupper($value);
    }

    /**
     * 2. Relasi: Satu siswa bisa ikut banyak ekskul.
     * (PENTING: Jangan dihapus agar error 'undefined method' hilang)
     */
    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class, 'ekskul_siswa')
            ->withPivot('no_wa', 'created_at')
            ->withTimestamps();
    }
}
