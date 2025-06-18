<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicioPrecio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'servicios_precio';

    protected $fillable = [
        'servicio_id',
        'empresa_id',
        'precio',
        'por_noche',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'por_noche' => 'boolean',
    ];

    //Relaciones
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
class Servicio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'tabla',
    ];

    //Relaciones
    public function precios()
    {
        return $this->hasMany(ServicioPrecio::class, 'servicio_id');
    }
}
