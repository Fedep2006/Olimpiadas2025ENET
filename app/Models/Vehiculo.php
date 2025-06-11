<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tipo',
        'marca',
        'modelo',
        'antiguedad',
        'patente',
        'color',
        'capacidad_pasajeros',
        'ubicacion',
        'precio_por_dia',
        'disponible',
        'imagen',
        'imagenes',
        'caracteristicas',
        'observaciones'
    ];

    protected $casts = [
        'imagenes' => 'array',
        'caracteristicas' => 'array',
        'disponible' => 'boolean',
        'capacidad_pasajeros' => 'integer',
        'precio_por_dia' => 'decimal:2',
        'tipo' => 'string'
    ];

    // Relaciones
    public function reservas()
    {
        return $this->morphMany(Reserva::class, 'servicio', 'tipo', 'servicio_id');
    }
}
