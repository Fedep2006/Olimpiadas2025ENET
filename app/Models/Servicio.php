<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'por_noche' => 'boolean',
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
    public function nombreServicio(): BelongsTo
    {
        return $this->belongsTo(NombreServicio::class, 'nombre_servicio_id');
    }

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function reservados(): HasMany
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
    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public function reservas(): BelongsTo
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }
}
