<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaVehiculoEnviada extends Mailable
{
    use Queueable, SerializesModels;

    public $vehiculo;
    public $reserva;

    public function __construct($vehiculo, $reserva)
    {
        $this->vehiculo = $vehiculo;
        $this->reserva = $reserva;
    }

    public function build()
    {
        return $this->subject('¡Tu reserva de vehículo fue recibida!')
            ->view('emails.reserva_enviada')
            ->with([
                'vehiculo' => $this->vehiculo,
                'reserva'  => $this->reserva,
            ]);
    }
}
