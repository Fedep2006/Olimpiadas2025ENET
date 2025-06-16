<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habitacion extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'habitaciones';

    protected $fillable = [
        'hospedaje_id',
        'numero',
        'tipo',
        'capacidad_personas',
        'precio_por_noche',
        'precio_extra_persona',
        'disponible',
        'caracteristicas',
        'servicios',
        'camas',
        'metros_cuadrados',
        'imagenes',
        'descripcion',
        'politicas',
        'observaciones'
    ];

    protected $casts = [
        'caracteristicas' => 'array',
        'servicios' => 'array',
        'camas' => 'array',
        'imagenes' => 'array',
        'politicas' => 'array',
        'disponible' => 'boolean',
        'precio_por_noche' => 'decimal:2',
        'precio_extra_persona' => 'decimal:2',
        'metros_cuadrados' => 'integer',
        'capacidad_personas' => 'integer',
        'tipo' => 'string'
    ];

    // Relaciones
    public function hospedaje()
    {
        return $this->belongsTo(Hospedaje::class, 'hospedaje_id');
    }

    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'habitaciones_id');
    }
}
