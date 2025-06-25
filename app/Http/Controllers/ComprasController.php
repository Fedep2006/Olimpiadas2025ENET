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

        // Cargar reservas pendientes
        $reservas_pendientes = Reserva::where('usuario_id', $user->id)
                                    ->where('estado', 'pendiente')
                                    ->with(['reservable', 'paquete'])
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        // Cargar reservas aceptadas (asumiendo que 'aceptada' es un estado válido)
        $reservas_aceptadas = Reserva::where('usuario_id', $user->id)
                                   ->where('estado', 'confirmada')
                                   ->with(['reservable', 'paquete'])
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        // Cargar reservas canceladas
        $reservas_canceladas = Reserva::where('usuario_id', $user->id)
                                    ->where('estado', 'cancelada')
                                    ->with(['reservable', 'paquete'])
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('mis-compras', compact('reservas_pendientes', 'reservas_aceptadas', 'reservas_canceladas'));
    }

    public function cancelar(Reserva $reserva)
    {
        if ($reserva->usuario_id !== auth()->id()) {
            abort(403, 'No tienes permiso para cancelar esta reserva.');
        }

        if ($reserva->estado !== 'pendiente') {
            return redirect()->route('mis-compras')->with('error', 'Solo se pueden cancelar reservas pendientes.');
        }

        $reserva->estado = 'cancelada';
        $reserva->save();

        return redirect()->route('mis-compras')->with('success', 'La reserva ha sido cancelada exitosamente.');
    }

    public function edit(Reserva $reserva)
    {
        if ($reserva->usuario_id !== auth()->id() || $reserva->estado !== 'pendiente') {
            abort(403, 'No tienes permiso para editar esta reserva.');
        }

        $reservable = $reserva->reservable;

        return view('mis-compras.edit', compact('reserva', 'reservable'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        if ($reserva->usuario_id !== auth()->id() || $reserva->estado !== 'pendiente') {
            abort(403, 'No tienes permiso para actualizar esta reserva.');
        }

        $reservable = $reserva->reservable;

        $validated = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'cantidad_personas' => 'required|integer|min:1',
        ]);

        $reserva->fecha_inicio = $validated['fecha_inicio'];
        
        // No guardamos cantidad_personas porque no existe en la tabla
        // Solo la usamos para calcular el precio total

        $precio_por_noche_o_persona = $reservable->precio;
        $total = 0;

        if ($reservable instanceof \App\Models\Hospedaje) {
            $reserva->fecha_fin = $validated['fecha_fin'];
            $fechaInicio = new \DateTime($validated['fecha_inicio']);
            $fechaFin = new \DateTime($validated['fecha_fin']);
            $diferencia = $fechaFin->diff($fechaInicio);
            $dias = $diferencia->days > 0 ? $diferencia->days : 1;
            $total = $dias * $precio_por_noche_o_persona * $validated['cantidad_personas'];
        } else if ($reservable instanceof \App\Models\Viaje) {
            $reserva->fecha_fin = $validated['fecha_fin'];
            $total = $precio_por_noche_o_persona * $validated['cantidad_personas'];
        } else {
            $total = $precio_por_noche_o_persona * $validated['cantidad_personas'];
        }

        $reserva->precio_total = $total;
        $reserva->save();

        return redirect()->route('mis-compras')->with('success', 'Reserva actualizada correctamente.');
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
