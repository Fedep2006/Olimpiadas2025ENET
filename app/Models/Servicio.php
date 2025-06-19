<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'nombre_servicio_id');
    }
}

class Servicio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'servicios';

    protected $fillable = [
        'nombre_servicio_id',
        'empresa_id',
        'precio',
        'por_noche',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'por_noche' => 'boolean',
    ];

    //Relaciones
    public function nombreServicio()
    {
        return $this->belongsTo(NombreServicio::class, 'nombre_servicio_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function reservados()
    {
        return $this->hasMany(ServicioReservado::class, 'servicio_id');
    }
}

class ServicioReservado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'servicios_reservados';

    protected $fillable = [
        'reserva_id',
        'servicio_id',
    ];

    //Relaciones
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public function reservas()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }
}
