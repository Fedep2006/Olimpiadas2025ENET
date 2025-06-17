<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdministracionController extends Controller
{
    public function inicio()
    {
        $hoy = now()->toDateString();
        $reservasRecientes = \App\Models\Reserva::with('usuario')
            ->whereDate('created_at', $hoy)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('administracion.inicio', compact('reservasRecientes'));
    }
    public function reservas()
    {
        // Vehículos
        $reservasVehiculosPendientes = \App\Models\Reserva::with('usuario')
            ->where('tipo', 'vehiculo')
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();
        $pagosVehiculos = [];
        foreach ($reservasVehiculosPendientes as $reserva) {
            $pago = \App\Models\Pagos::where('reserva_id', $reserva->id)->first();
            if ($pago) {
                $pagosVehiculos[$reserva->id] = $pago;
            }
        }
        // Hospedaje
        $reservasHospedajePendientes = \App\Models\Reserva::with(['usuario', 'habitaciones'])
            ->where('tipo', 'hospedaje')
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();
        $pagosHospedaje = [];
        foreach ($reservasHospedajePendientes as $reserva) {
            $pago = \App\Models\Pagos::where('reserva_id', $reserva->id)->first();
            if ($pago) {
                $pagosHospedaje[$reserva->id] = $pago;
            }
        }
        // Historial de vehículos
        $reservasHistoricas = \App\Models\Reserva::with('usuario')
            ->where('tipo', 'vehiculo')
            ->where('estado', 'confirmada')
            ->orderBy('created_at', 'desc')
            ->get();
        $pagosHistoricos = [];
        foreach ($reservasHistoricas as $reserva) {
            $pago = \App\Models\Pagos::where('reserva_id', $reserva->id)->where('estado', 'confirmada')->first();
            if ($pago) {
                $pagosHistoricos[$reserva->id] = $pago;
            }
        }
        // Historial de hospedaje
        $reservasHospedajeHistoricas = \App\Models\Reserva::with(['usuario', 'habitaciones'])
            ->where('tipo', 'hospedaje')
            ->where('estado', 'confirmada')
            ->orderBy('created_at', 'desc')
            ->get();
        $pagosHospedajeHistoricos = [];
        foreach ($reservasHospedajeHistoricas as $reserva) {
            $pago = \App\Models\Pagos::where('reserva_id', $reserva->id)->where('estado', 'confirmada')->first();
            if ($pago) {
                $pagosHospedajeHistoricos[$reserva->id] = $pago;
            }
        }
        // Viajes
        $reservasViajesPendientes = \App\Models\ReservaViaje::with(['usuario', 'viaje'])
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();
        $pagosViajes = [];
        foreach ($reservasViajesPendientes as $reserva) {
            $pago = \App\Models\Pagos::where('reserva_viaje_id', $reserva->id)->first();
            if ($pago) {
                $pagosViajes[$reserva->id] = $pago;
            }
        }
        return view('administracion.reservas', compact(
            'reservasVehiculosPendientes', 'pagosVehiculos',
            'reservasHospedajePendientes', 'pagosHospedaje',
            'reservasHistoricas', 'pagosHistoricos',
            'reservasHospedajeHistoricas', 'pagosHospedajeHistoricos',
            'reservasViajesPendientes', 'pagosViajes'
        ));
    }

    /**
     * Aceptar reserva de hospedaje: cambia estado a aceptado, envía mail y simula descuento.
     */
    public function aceptarReservaHospedaje(\Illuminate\Http\Request $request, $reservaId)
    {
        $reserva = \App\Models\Reserva::where('id', $reservaId)->where('tipo', 'hospedaje')->first();
        if (!$reserva) {
            return redirect()->back()->with('error', 'Reserva de hospedaje no encontrada.');
        }
        $pago = \App\Models\Pagos::where('reserva_id', $reserva->id)->first();
        // Cambiar estado
        $reserva->estado = 'confirmada';
        $reserva->save();
        if ($pago) {
            $pago->estado = 'confirmada';
            $pago->save();
        }
        // Enviar mail al cliente
        try {
            \Mail::raw('Su reserva de hospedaje ha sido aceptada. Gracias por confiar en nosotros.', function($message) use ($reserva) {
                $message->to($reserva->usuario->email)
                        ->subject('Reserva de hospedaje aceptada');
            });
        } catch (\Exception $e) {}
        // Simulación de descuento en tarjeta (aquí solo se marca como pagado)
        $reserva->pagado = true;
        $reserva->fecha_pago = now();
        $reserva->save();
        return redirect()->back()->with('success', 'Reserva de hospedaje aceptada, cliente notificado y pago registrado.');
    }

    /**
     * Rechazar reserva de hospedaje: requiere motivo, envía mail y elimina reserva y pago.
     */
    public function rechazarReservaHospedaje(\Illuminate\Http\Request $request, $reservaId)
    {
        $request->validate([
            'motivo' => 'required|string|min:5',
        ]);
        $reserva = \App\Models\Reserva::where('id', $reservaId)->where('tipo', 'hospedaje')->first();
        if (!$reserva) {
            return redirect()->back()->with('error', 'Reserva de hospedaje no encontrada.');
        }
        $pago = \App\Models\Pagos::where('reserva_id', $reserva->id)->first();
        // Enviar mail al cliente con motivo
        try {
            \Mail::raw('Su reserva de hospedaje ha sido rechazada. Motivo: ' . $request->motivo, function($message) use ($reserva) {
                $message->to($reserva->usuario->email)
                        ->subject('Reserva de hospedaje rechazada');
            });
        } catch (\Exception $e) {}
        // Eliminar reserva y pago
        if ($pago) { $pago->delete(); }
        $reserva->delete();
        return redirect()->back()->with('success', 'Reserva de hospedaje rechazada, cliente notificado y datos eliminados.');
    }
    public function vehiculos()
    {
        return view('administracion.vehiculos');
    }

    //Seccion Hospedaje
    public function hospedaje()
    {

        return view('administracion.hospedaje');
    }

    //Seccion Paquetes
    public function paquetes()
    {
        return view('administracion.paquetes');
    }
    public function reportes()
    {
        return view('administracion.reportes');
    }
    public function usuarios()
    {
        return view('administracion.usuarios');
    }
    public function vuelos()
    {
        return view('administracion.viajes');
    }


    /**
     * Aceptar reserva de vehículo: cambia estado a aceptado, envía mail y simula descuento.
     */
    public function aceptarReservaVehiculo(\Illuminate\Http\Request $request, $reservaId)
    {
        $reserva = \App\Models\Reserva::where('id', $reservaId)->where('tipo', 'vehiculo')->first();
        if (!$reserva) {
            return redirect()->back()->with('error', 'Reserva no encontrada.');
        }
        $pago = \App\Models\Pagos::where('reserva_id', $reserva->id)->first();
        // Cambiar estado
        $reserva->estado = 'confirmada';
        $reserva->save();
        if ($pago) {
            $pago->estado = 'confirmada';
            $pago->save();
        }
        // Enviar mail al cliente
        try {
            \Mail::raw('Su reserva de vehículo ha sido aceptada. Gracias por confiar en nosotros.', function($message) use ($reserva) {
                $message->to($reserva->usuario->email)
                        ->subject('Reserva de vehículo aceptada');
            });
        } catch (\Exception $e) {}
        // Simulación de descuento en tarjeta (aquí solo se marca como pagado)
        $reserva->pagado = true;
        $reserva->fecha_pago = now();
        $reserva->save();
        return redirect()->back()->with('success', 'Reserva aceptada, cliente notificado y pago registrado.');
    }

    /**
     * Rechazar reserva de vehículo: requiere motivo, envía mail y elimina reserva y pago.
     */
    public function rechazarReservaVehiculo(\Illuminate\Http\Request $request, $reservaId)
    {
        $request->validate([
            'motivo' => 'required|string|min:5',
        ]);
        $reserva = \App\Models\Reserva::where('id', $reservaId)->where('tipo', 'vehiculo')->first();
        if (!$reserva) {
            return redirect()->back()->with('error', 'Reserva no encontrada.');
        }
        $pago = \App\Models\Pagos::where('reserva_id', $reserva->id)->first();
        // Enviar mail al cliente con motivo
        try {
            \Mail::raw('Su reserva de vehículo ha sido rechazada. Motivo: ' . $request->motivo, function($message) use ($reserva) {
                $message->to($reserva->usuario->email)
                        ->subject('Reserva de vehículo rechazada');
            });
        } catch (\Exception $e) {}
        // Eliminar reserva y pago
        if ($pago) { $pago->delete(); }
        $reserva->delete();
        return redirect()->back()->with('success', 'Reserva rechazada, cliente notificado y datos eliminados.');
    }
}
