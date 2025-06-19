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
        'caracteristicas',
    ];

    protected function casts(): array
    {
        return [
            'caracteristicas' => 'array',
            'disponible' => 'boolean',
            'capacidad_pasajeros' => 'integer',
            'precio_por_dia' => 'decimal:2',
            'tipo' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected function hidden(): array
    {
        return [
            'deleted_at',
        ];
    }

    // Relaciones
    public function reservas()
    {
        return $this->morphMany(Reserva::class, 'servicio', 'tipo', 'servicio_id');
    }
}
