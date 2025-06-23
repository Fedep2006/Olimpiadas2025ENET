<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservaHospedaje extends Model
{
    use SoftDeletes;

    protected $table = 'reserva_hospedajes';

    protected $fillable = [
        'hospedaje_id',
        'user_id',
        'pago_id',
        'nombre_hospedaje',
        'tipo_hospedaje',
        'direccion',
        'pais_id',
        'provincia_id',
        'ciudad_id',
        'precio_por_noche',
        'fecha_checkin',
        'fecha_checkout',
        'estado',
        'notas',
    ];

    protected $casts = [
        'fecha_checkin' => 'date',
        'fecha_checkout' => 'date',
        'precio_por_noche' => 'decimal:2',
    ];

    // Relaciones
    public function hospedaje()
    {
        return $this->belongsTo(Hospedaje::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}
