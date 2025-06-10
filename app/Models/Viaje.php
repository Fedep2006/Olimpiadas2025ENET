<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    public function reservaViajes()
    {
        return $this->hasMany(ReservaViaje::class);
    }
}
