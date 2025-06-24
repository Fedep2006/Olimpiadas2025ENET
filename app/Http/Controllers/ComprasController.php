<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;

class ComprasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Cargar las reservas con sus relaciones polimórficas (hospedaje, viaje, etc.)
        $reservas = Reserva::where('usuario_id', $user->id)
                            ->with(['reservable', 'paquete']) 
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('mis-compras', compact('reservas'));
    }
    public function cancelar(Reserva $reserva)
    {
        // Verificar que el usuario autenticado es el dueño de la reserva
        if (Auth::id() !== $reserva->usuario_id) {
            abort(403, 'No tienes permiso para cancelar esta reserva.');
        }

        // Verificar que la reserva esté en un estado que permita la cancelación (ej. 'pendiente')
        if ($reserva->estado !== 'pendiente') {
            return redirect()->route('mis-compras')->with('error', 'Esta reserva no se puede cancelar.');
        }

        // Cambiar el estado de la reserva a 'cancelado'
        $reserva->estado = 'cancelada';
        $reserva->save();

        return redirect()->route('mis-compras')->with('success', 'Reserva cancelada correctamente.');
    }

    public function modificar(Reserva $reserva)
    {
        if (Auth::id() !== $reserva->usuario_id) {
            abort(403, 'No tienes permiso para modificar esta reserva.');
        }

        $item = $reserva->reservable ?? $reserva->paquete;

        if (!$item) {
            return redirect()->route('mis-compras')->with('error', 'No se pudo encontrar el detalle del producto para modificar.');
        }

        $routeName = '';
        if ($reserva->reservable) {
            $type = class_basename($reserva->reservable_type);
            switch ($type) {
                case 'Hospedaje':
                    $routeName = 'hospedajes.show';
                    break;
                case 'Viaje':
                    $routeName = 'viajes.show';
                    break;
                case 'Vehiculo':
                    $routeName = 'vehiculos.show';
                    break;
            }
            return redirect()->route($routeName, ['id' => $item->id]);
        } elseif ($reserva->paquete) {
            // Para paquetes, redirigimos a la home ya que no tienen una página de detalle única.
            return redirect()->route('home')->with('info', 'La modificación de paquetes te redirige a la página principal.');
        }

        return redirect()->route('mis-compras')->with('error', 'No se puede modificar este tipo de reserva.');
    }
}
