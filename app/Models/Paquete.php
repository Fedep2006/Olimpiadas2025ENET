<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paquete extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_total',
        'duracion',
        'ubicacion',
        'cupo_minimo',
        'cupo_maximo',
        'numero_paquete',
        'hecho_por_usuario',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'precio_total' => 'decimal:2',
            'cupo_minimo' => 'integer',
            'cupo_maximo' => 'integer',
            'hecho_por_usuario' => 'boolean',
            'activo' => 'boolean',
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
    public function contenidos(): HasMany
    {
        return $this->hasMany(PaqueteContenido::class, 'paquete_id');
    }

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class, 'paquete_id');
    }

    public function serviciosTotales(): MorphMany
    {
        return $this->morphMany(Servicio::class, 'serviciable')->whereHas('nombre', function ($query) {
            $query->where('tabla', 'paquetes');
        });
    }

    // Funciones
    public function serviciosIndividuales()
    {
        return $this->morphMany(Servicio::class, 'serviciable')
            ->whereHas('nombre', function ($query) {
                $query->where('tabla', 'paquetes');
            })
            ->where('empresa_id', $this->empresa_id);
    }
}
