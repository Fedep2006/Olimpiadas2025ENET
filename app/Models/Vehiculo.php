<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
        'pais',
        'ubicacion',
        'precio_por_dia',
        'disponible',
        'descripcion',
    ];

    protected function casts(): array
    {
        return [
            'precio_por_dia' => 'decimal:2',
            'disponible' => 'boolean',
            'capacidad_pasajeros' => 'integer',
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
    public function paquetesContenidos(): MorphMany
    {
        return $this->morphMany(PaqueteContenido::class, 'contenido');
    }
}
