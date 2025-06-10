<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaHospedaje extends Model
{
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function hospedaje()
    {
        return $this->belongsTo(Hospedaje::class);
    }
}
