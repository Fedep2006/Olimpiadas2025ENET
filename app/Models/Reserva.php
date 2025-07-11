<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reservas';

    protected $fillable = [
        'usuario_id',
        'paquete_id',
        'reservable_id',
        'reservable_type',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'tipo_reserva',
        'precio_total',
        'codigo_reserva',
        'hecho_por_usuario',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'datetime',
            'fecha_fin' => 'datetime',
            'precio_total' => 'decimal:2',
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

    // Relaciones
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function paquete(): BelongsTo
    {
        return $this->belongsTo(Paquete::class, 'paquete_id');
    }

    public function pago(): HasOne
    {
        return $this->hasOne(Pago::class, 'reserva_id');
    }

    /**
     * Relación polimórfica hacia el modelo reservable (hospedaje, vehiculo, viaje, etc.).
     */
    public function reservable(): MorphTo
    {
        return $this->morphTo();
    }
}
