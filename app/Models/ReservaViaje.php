<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaViaje extends Model
{
    protected $table = 'reservas_viaje';
    protected $fillable = [
        'usuario_id',
        'viaje_id',
        'cantidad',
        'pasajeros',
        'precio_total',
        'estado',
        'metodo_pago',
        'pagado',
        'fecha_pago',
        'observaciones',
    ];
    protected $casts = [
        'pasajeros' => 'array',
        'pagado' => 'boolean',
        'fecha_pago' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }
}
