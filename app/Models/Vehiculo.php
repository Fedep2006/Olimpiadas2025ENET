<?php

namespace App\Models;

use App\Models\ubicacion\Ciudad;
use App\Models\ubicacion\Pais;
use App\Models\ubicacion\Provincia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'vehiculos_disponibles',
        'pais_id',
        'provincia_id',
        'ciudad_id',
        'ubicacion',
        'precio_por_dia',
        'descripcion',
        'disponible'
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
    public function pais(): BelongsTo
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }
    public function ciudad(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }
}
