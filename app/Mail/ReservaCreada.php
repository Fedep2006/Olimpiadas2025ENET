<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ReservaCreada extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reservas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, array $reservas)
    {
        $this->user = $user;
        $this->reservas = $reservas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmación de tu reserva - Frategar')
                    ->view('emails.reserva_creada');
    }
}
