<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
        'tipo'
    ];

    //Relaciones
    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'empresa_id');
    }

    public function viajes()
    {
        return $this->hasMany(Viaje::class, 'empresa_id');
    }

    public function hospedajes()
    {
        return $this->hasMany(Hospedaje::class, 'empresa_id');
    }
}
