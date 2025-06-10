<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaViaje extends Model
{
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function viaje()
    {
        return $this->belongsTo(Viaje::class);
    }
}
