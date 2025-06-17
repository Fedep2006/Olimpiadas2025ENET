<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViajePasajero extends Model
{
    use HasFactory;
    protected $fillable = [
        'reserva_id', 'nombre', 'dni'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }
}
