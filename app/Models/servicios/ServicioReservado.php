<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
