<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
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

    public function personasConReservas(): HasMany
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

    //Relaciones
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    public function reserva(): BelongsTo
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }
}
