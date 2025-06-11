<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

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
        'email',
        'observaciones'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date'
    ];

    // Relaciones
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'persona_id');
    }

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'persona_id');
    }
}
