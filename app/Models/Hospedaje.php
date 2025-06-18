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

    protected $casts = [
        'check_in' => 'datetime:H:i:s',
        'check_out' => 'datetime:H:i:s',
        'activo' => 'boolean',
        'precio_por_noche' => 'decimal:2',
        'calificacion' => 'decimal:2',
    ];

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
