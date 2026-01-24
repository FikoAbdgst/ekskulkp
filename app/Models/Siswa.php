<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama_siswa', 'nisn', 'kelas'];

    // Relasi: Satu siswa bisa ikut banyak ekskul
    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class, 'ekskul_siswa')
            ->withPivot('no_wa', 'created_at')
            ->withTimestamps();
    }
}
