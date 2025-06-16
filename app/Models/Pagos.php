<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $fillable = [
        'vehiculo_id', 'reserva_id', 'cardholder_name',
        'card_number', 'expiration_month',
        'expiration_year', 'cvv', 'amount', 'estado',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
