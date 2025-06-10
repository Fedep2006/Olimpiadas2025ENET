<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    public function reservaVehiculos()
    {
        return $this->hasMany(reservaVehiculo::class);
    }
}
