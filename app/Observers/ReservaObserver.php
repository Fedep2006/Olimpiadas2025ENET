<?php

namespace App\Observers;

use App\Models\Reserva;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservaHospedajeEnviada;
use App\Mail\ReservaVehiculoEnviada;
use App\Mail\ReservaViajeEnviada;
use App\Mail\ReservaCreada;

class ReservaObserver
{
    /**
     * Handle the Reserva "created" event.
     */
    public function created(Reserva $reserva): void
    {
        $user = $reserva->usuario; // relación definida en el modelo
        if(!$user) {
            return; // sin usuario no se puede notificar
        }

        switch ($reserva->tipo_reserva) {
            case 'hospedaje':
                if ($reserva->reservable) {
                    Mail::to($user->email)->send(new ReservaHospedajeEnviada($reserva->reservable, $reserva));
                }
                break;
            case 'vehiculo':
                if ($reserva->reservable) {
                    Mail::to($user->email)->send(new ReservaVehiculoEnviada($reserva->reservable, $reserva));
                }
                break;
            case 'viaje':
                if ($reserva->reservable) {
                    Mail::to($user->email)->send(new ReservaViajeEnviada($reserva->reservable, $reserva));
                }
                break;
            default:
                // Paquete u otros: usar email genérico
                Mail::to($user->email)->send(new ReservaCreada($reserva));
                break;
        }
    }
}
