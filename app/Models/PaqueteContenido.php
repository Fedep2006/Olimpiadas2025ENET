<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqueteContenido extends Model
{
    public function paquete()
    {
        return $this->belongsTo(paquete::class);
    }
}
