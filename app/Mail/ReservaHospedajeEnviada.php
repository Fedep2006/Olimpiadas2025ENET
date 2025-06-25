<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaHospedajeEnviada extends Mailable
{
    use Queueable, SerializesModels;

    public $hospedaje;
    public $reserva;

    public function __construct($hospedaje, $reserva)
    {
        $this->hospedaje = $hospedaje;
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->subject('¡Tu reserva de hospedaje fue recibida!')
            ->view('emails.reserva_hospedaje_enviada')
            ->with([
                'hospedaje' => $this->hospedaje,
                'reserva'   => $this->reserva,
            ]);
    }
}
