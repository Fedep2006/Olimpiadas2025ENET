<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaViajeEnviada extends Mailable
{
    use Queueable, SerializesModels;

    public $viaje;
    public $reserva;

    public function __construct($viaje, $reserva)
    {
        $this->viaje = $viaje;
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->subject('¡Tu reserva de viaje fue recibida!')
            ->view('emails.reserva_viaje_enviada')
            ->with([
                'viaje' => $this->viaje,
                'reserva' => $this->reserva,
            ]);
    }
}
