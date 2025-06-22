<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NombreServicio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nombre_servicio_id';

    protected $fillable = [
        'nombre',
        'tabla',
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

    //Relaciones
    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class, 'nombre_servicio_id');
    }
}
