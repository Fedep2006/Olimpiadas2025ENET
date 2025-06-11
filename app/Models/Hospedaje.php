<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospedaje extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'tipo',
        'ubicacion',
        'pais',
        'ciudad',
        'codigo_postal',
        'estrellas',
        'disponibilidad',
        'imagen',
        'descripcion',
        'servicios',
        'imagenes',
        'telefono',
        'email',
        'sitio_web',
        'check_in',
        'check_out',
        'check_in_24h',
        'calificacion',
        'politicas',
        'observaciones'
    ];

    protected $casts = [
        'servicios' => 'array',
        'imagenes' => 'array',
        'politicas' => 'array',
        'disponibilidad' => 'boolean',
        'check_in_24h' => 'boolean',
        'estrellas' => 'integer',
        'calificacion' => 'decimal:2',
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'tipo' => 'string'
    ];

    // Relaciones
    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class, 'hospedaje_id');
    }

    public function reservas()
    {
        return $this->morphMany(Reserva::class, 'servicio', 'tipo', 'servicio_id');
    }
}
