<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pagos';

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

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected function hidden(): array
    {
        return [
            'card_number',
            'cvv',
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
