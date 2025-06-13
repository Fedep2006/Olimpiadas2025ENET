<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preferencia extends Model
{
    // Opcional: si vas a usar asignación masiva (create, update):
    protected $fillable = [
        'nombre',
        'descripcion',
        'origen',
        'destino',
        'fecha_entrada',
        'fecha_salida',
        'max_huespedes',
        'precio',
    ];
}

