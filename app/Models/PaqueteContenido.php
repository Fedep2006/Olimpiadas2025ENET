<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaqueteContenido extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'paquete_contenido';

    protected $fillable = [
        'paquete_id',
        'tipo_contenido',
        'contenido_id',
    ];

    protected function casts(): array
    {
        return [
            'tipo_contenido' => 'string',
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
    public function paquete()
    {
        return $this->belongsTo(Paquete::class, 'paquete_id');
    }

    public function contenido()
    {
        return $this->morphTo('contenido', 'tipo_contenido', 'contenido_id');
    }
}
