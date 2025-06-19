<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $fillable = [
        'vehiculo_id',
        'reserva_id',
        'cardholder_name',
        'card_number',
        'expiration_month',
        'expiration_year',
        'cvv',
        'amount',
        'estado',
    ];

    protected function casts(): array
    {
        return [
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

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
