<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospedaje extends Model
{
    public function reservaHospedajes()
    {
        return $this->hasMany(reservaHospedaje::class);
    }
}
