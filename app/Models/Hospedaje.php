<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospedaje extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hospedajes';

    protected $fillable = [
        'nombre',
        'empresa_id',
        'tipo',
        'habitacion',
        'habitaciones_disponibles',
        'capacidad_personas',
        'precio_por_noche',
        'ubicacion',
        'pais',
        'ciudad',
        'estrellas',
        'descripcion',
        'telefono',
        'email',
        'sitio_web',
        'check_in',
        'check_out',
        'calificacion',
        'activo',
        'condiciones',
    ];


    protected function casts(): array
    {
        return [
            'precio_por_noche' => 'decimal:2',
            'calificacion' => 'decimal:2',
            'activo' => 'boolean',
            'check_in' => 'datetime:H:i',
            'check_out' => 'datetime:H:i',
            'habitaciones_disponibles' => 'integer',
            'capacidad_personas' => 'integer',
            'estrellas' => 'integer',
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

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function servicios(): MorphMany
    {
        return $this->morphMany(Servicio::class, 'serviciable')->whereHas('nombre', function ($query) {
            $query->where('tabla', 'hospedajes');
        });
    }

    // Funciones
    public function serviciosIndividuales()
    {
        return $this->morphMany(Servicio::class, 'serviciable')
            ->whereHas('nombre', function ($query) {
                $query->where('tabla', 'hospedajes');
            })
            ->where('empresa_id', $this->empresa_id);
    }
}
