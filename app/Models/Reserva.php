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
        'paquete_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'precio_total',
        'codigo_reserva',
    ];
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'precio_total' => 'decimal:2',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'paquete_id');
    }

    public function serviciosReservados()
    {
        return $this->hasMany(ServicioReservado::class, 'reserva_id');
    }

    public function personasConReservas()
    {
        return $this->hasMany(PersonaReserva::class, 'reserva_id');
    }
}
