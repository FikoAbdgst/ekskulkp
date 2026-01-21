<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registrant extends Model
{
    protected $guarded = [];
    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class);
    }
}
