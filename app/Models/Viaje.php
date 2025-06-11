<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'origen',
        'destino',
        'fecha_salida',
        'fecha_llegada',
        'precio',
        'descripcion',
        'imagen'
    ];

    protected $casts = [
        'fecha_salida' => 'datetime',
        'fecha_llegada' => 'datetime',
        'precio' => 'decimal:2'
    ];

    public function reservaViajes()
    {
        return $this->hasMany(ReservaViaje::class);
    }

    public function setImagenAttribute($value)
    {
        if ($value) {
            $this->attributes['imagen'] = $value;
        }
    }

    public function getImagenAttribute($value)
    {
        if ($value) {
            return base64_encode($value);
        }
        return null;
    }
}
