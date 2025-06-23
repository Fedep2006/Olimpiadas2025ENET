<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservaVehiculo extends Model
{
    use SoftDeletes;

    protected $table = 'reserva_vehiculos';
    
    protected $fillable = [
        'vehiculo_id',
        'user_id',
        'pago_id',
        'tipo',
        'marca',
        'modelo',
        'antiguedad',
        'patente',
        'color',
        'capacidad_pasajeros',
        'pais_id',
        'provincia_id',
        'ciudad_id',
        'ubicacion',
        'precio_por_dia',
        'fecha_retiro',
        'fecha_devolucion',
        'estado',
        'notas',
    ];

    protected $casts = [
        'fecha_retiro' => 'date',
        'fecha_devolucion' => 'date',
        'precio_por_dia' => 'decimal:2',
    ];

    // Relaciones
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
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
