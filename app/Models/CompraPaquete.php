<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\CompraConfirmada;
use App\Notifications\EstadoCompraActualizado;

class CompraPaquete extends Model
{
    protected $fillable = [
        'usuario_id',
        'paquete_id',
        'fecha_compra',
        'estado',
        'total'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function paquete()
    {
        return $this->belongsTo(Paquete::class);
    }

    public function confirmar()
    {
        $this->estado = 'confirmado';
        $this->save();
        
        // Enviar notificación de confirmación
        $this->usuario->notify(new CompraConfirmada($this));
    }

    public function actualizarEstado($nuevoEstado)
    {
        $estadoAnterior = $this->estado;
        $this->estado = $nuevoEstado;
        $this->save();
        
        // Enviar notificación de actualización de estado
        $this->usuario->notify(new EstadoCompraActualizado($this, $estadoAnterior, $nuevoEstado));
    }
}
