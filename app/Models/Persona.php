<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'nacionalidad',
        'direccion',
        'ciudad',
        'pais',
        'telefono',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function personasConReservas()
    {
        return $this->hasMany(PersonaReserva::class, 'persona_id');
    }
}

class PersonaReserva extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reservas_personas';

    protected $fillable = [
        'reserva_id',
        'persona_id'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }
}
