<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'monto',
        'moneda',
        'metodo_pago',
        'estado',
        'referencia_pago',
        'fecha_pago',
        'tarjeta_ultimos_digitos',
        'tarjeta_marca',
        'nombre_titular',
        'user_id',
        'detalles_adicionales',
    ];

    protected $casts = [
        'fecha_pago' => 'datetime',
        'monto' => 'decimal:2',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservaHospedaje()
    {
        return $this->hasOne(ReservaHospedaje::class);
    }

    public function reservaViaje()
    {
        return $this->hasOne(ReservaViaje::class);
    }

    public function reservaVehiculo()
    {
        return $this->hasOne(ReservaVehiculo::class);
    }
}
