<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hoteles';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'pais',
        'estrellas',
        'habitaciones',
        'tipos_habitacion',
        'precio_por_noche',
        'disponibilidad'
    ];

    protected $casts = [
        'estrellas' => 'integer',
        'habitaciones' => 'integer',
        'precio_por_noche' => 'decimal:2',
        'disponibilidad' => 'boolean'
    ];
} 