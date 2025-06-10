<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
    public function compraPaquetes()
    {
        return $this->hasMany(CompraPaquete::class);
    }
    public function paqueteContenidos()
    {
        return $this->hasMany(PaqueteContenido::class);
    }
}
