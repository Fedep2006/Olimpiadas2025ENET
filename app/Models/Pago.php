<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reserva_id',
        'estado',
        'cardholder_name',
        'card_number',
        'expiration_month',
        'expiration_year',
        'cvv',
        'amount',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the reserva that owns the pago.
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }
}
