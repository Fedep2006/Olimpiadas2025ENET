<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'usuario_id',
        'persona_id',
        'puesto',
        'nivel',
        'fecha_contratacion',
        'salario',
        'estado',
        'habilidades',
        'certificaciones',
        'observaciones'
    ];

    protected $casts = [
        'fecha_contratacion' => 'date',
        'salario' => 'decimal:2',
        'nivel' => 'integer',
        'habilidades' => 'array',
        'certificaciones' => 'array'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
