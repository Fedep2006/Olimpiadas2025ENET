<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EstadoCompraActualizado extends Notification implements ShouldQueue
{
    use Queueable;

    protected $compra;
    protected $estadoAnterior;
    protected $estadoNuevo;

    public function __construct($compra, $estadoAnterior, $estadoNuevo)
    {
        $this->compra = $compra;
        $this->estadoAnterior = $estadoAnterior;
        $this->estadoNuevo = $estadoNuevo;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Actualización de estado de tu compra')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('El estado de tu compra ha sido actualizado.')
            ->line('Detalles de la actualización:')
            ->line('- Número de compra: ' . $this->compra->id)
            ->line('- Estado anterior: ' . $this->estadoAnterior)
            ->line('- Nuevo estado: ' . $this->estadoNuevo)
            ->action('Ver detalles de la compra', url('/mis-compras/' . $this->compra->id))
            ->line('Si tienes alguna pregunta, no dudes en contactarnos.');
    }
} 