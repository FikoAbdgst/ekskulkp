<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $guarded = [];
    public function registrants()
    {
        return $this->hasMany(Registrant::class);
    }
}
