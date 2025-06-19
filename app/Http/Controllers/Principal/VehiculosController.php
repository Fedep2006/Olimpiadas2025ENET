<?php

namespace App\Http\Controllers\Principal;

use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculoRequest;
use Illuminate\Support\Facades\Auth;

class VehiculosController extends Controller
{
    // Muestra el detalle de un vehículo
    public function show($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        // Buscar la reserva activa para este vehículo y usuario
        $reserva = \App\Models\Reserva::where('tipo', 'vehiculo')
            ->where('servicio_id', $vehiculo->id)
            ->where('usuario_id', Auth::id())
            ->latest()
            ->first();
        return view('detalles', compact('vehiculo', 'reserva'));
    }
}
