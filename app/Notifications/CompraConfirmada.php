<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompraConfirmada extends Notification implements ShouldQueue
{
    use Queueable;

    protected $compra;

    public function __construct($compra)
    {
        $this->compra = $compra;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('¡Tu compra ha sido confirmada!')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Tu compra ha sido procesada exitosamente.')
            ->line('Detalles de la compra:')
            ->line('- Número de compra: ' . $this->compra->id)
            ->line('- Fecha: ' . $this->compra->fecha_compra)
            ->line('- Total: $' . $this->compra->total)
            ->action('Ver detalles de la compra', url('/mis-compras/' . $this->compra->id))
            ->line('¡Gracias por tu compra!');
    }
} 