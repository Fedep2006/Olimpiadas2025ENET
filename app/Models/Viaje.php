<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Viaje extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'tipo',
        'origen',
        'destino',
        'fecha_salida',
        'fecha_llegada',
        'empresa',
        'numero_viaje',
        'capacidad_total',
        'asientos_disponibles',
        'precio_base',
        'clases',
        'descripcion',
        'activo'
    ];

    protected $casts = [
        'fecha_salida' => 'datetime',
        'fecha_llegada' => 'datetime',
        'activo' => 'boolean',
        'capacidad_total' => 'integer',
        'asientos_disponibles' => 'integer',
        'precio_base' => 'decimal:2',
        'tipo' => 'string'
    ];

    // Relaciones
    public function reservas()
    {
        return $this->morphMany(Reserva::class, 'servicio', 'tipo', 'servicio_id');
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
