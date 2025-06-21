<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'tipo'
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

    public function setNombreAttribute($value): void
    {
        $this->attributes['nombre'] = Str::title(Str::trim($value));
    }

    //Relaciones
    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class, 'empresa_id');
    }

    public function viajes(): HasMany
    {
        return $this->hasMany(Viaje::class, 'empresa_id');
    }

    public function hospedajes(): HasMany
    {
        return $this->hasMany(Hospedaje::class, 'empresa_id');
    }
}
