<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaVehiculo extends Model
{
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
