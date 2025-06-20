<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Viaje extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'empresa_id',
        'nombre',
        'tipo',
        'origen',
        'destino',
        'fecha_salida',
        'fecha_llegada',
        'numero_viaje',
        'capacidad_total',
        'asientos_disponibles',
        'precio_base',
        'descripcion',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'empresa_id' => 'integer',
            'fecha_salida' => 'datetime',
            'fecha_llegada' => 'datetime',
            'capacidad_total' => 'integer',
            'asientos_disponibles' => 'integer',
            'precio_base' => 'decimal:2',
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
    public function reservas()
    {
        return $this->morphMany(Reserva::class, 'servicio', 'tipo', 'servicio_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function serviciosTotales()
    {
        return $this->morphMany(Servicio::class, 'serviciable')->whereHas('nombre', function ($query) {
            $query->where('tabla', 'viajes');
        });
    }

    // Funciones
    public function serviciosIndividuales()
    {
        return $this->morphMany(Servicio::class, 'serviciable')
            ->whereHas('nombre', function ($query) {
                $query->where('tabla', 'viajes');
            })
            ->where('empresa_id', $this->empresa_id);
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
