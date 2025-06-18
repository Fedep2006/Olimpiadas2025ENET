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
        'servicios_precio_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'precio_total',
        'precio_total',
        'codigo_reserva'
    ];

    protected $casts = [
        'servicios_precio_id' => 'array',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'precio_total' => 'decimal:2'
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

    public function servicios()
    {
        // Si servicios_precio_id contiene IDs de servicios
        return $this->belongsToMany(Servicio::class, null, null, null)
            ->whereIn('servicios.id', $this->servicios_precio_id ?? []);
    }
}
