<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $guarded = [];

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'ekskul_siswa')
            ->withPivot('no_wa', 'created_at')
            ->withTimestamps();
    }
}
