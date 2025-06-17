<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reservas';

    protected $fillable = [
        'usuario_id',
        'tipo',
        'servicio_id',
        'fecha_inicio',
        'fecha_fin',
        'ubicacion',
        'estado',
        'habitaciones_id',
        'precio_total',
        'codigo_reserva',
        'observaciones',
        'metodo_pago',
        'pagado',
        'fecha_pago'
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'fecha_pago' => 'date',
        'habitaciones_id' => 'array',
        'pagado' => 'boolean',
        'precio_total' => 'decimal:2'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'habitaciones_id');
    }

    public function servicio()
    {
        return $this->morphTo('servicio', 'tipo', 'servicio_id');
    }
}
