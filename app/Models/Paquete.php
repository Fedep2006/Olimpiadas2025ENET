<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'activo',
        'hecho_por_usuario',
        'condiciones',
    ];

    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'hecho_por_usuario' => 'boolean',
            'precio_total' => 'decimal:2',
            'cupo_minimo' => 'integer',
            'cupo_maximo' => 'integer',
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
    public function contenidos()
    {
        return $this->hasMany(PaqueteContenido::class, 'paquete_id');
    }

    public function reservas()
    {
        return $this->morphMany(Reserva::class, 'servicio', 'tipo', 'servicio_id');
    }

    public function serviciosTotales()
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
