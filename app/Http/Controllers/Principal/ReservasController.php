<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;

class ReservasController extends Controller {
    // Eliminar producto del carrito por clave
    public function removeFromCart(\Illuminate\Http\Request $request)
    {
        $carrito = session()->get('carrito', []);
        $key = $request->input('key');
        if(isset($carrito[$key])) {
            unset($carrito[$key]);
            session(['carrito' => $carrito]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    public function addHospedajeToCart($id)
    {
        $hospedaje = \App\Models\Hospedaje::findOrFail($id);
        $carrito = session()->get('carrito', []);
        $key = 'hospedaje_' . $id;
        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += 1;
        } else {
            $carrito[$key] = [
                'id' => $hospedaje->id,
                'nombre' => $hospedaje->nombre,
                'precio' => $hospedaje->precio_por_noche,
                'tipo' => 'hospedaje',
                'cantidad' => 1
            ];
        }
        session(['carrito' => $carrito]);
        return redirect('/login/carrito')->with('success', 'Hospedaje añadido al carrito.');
    }

    public function reservarHospedaje($id)
    {
        // Aquí deberías procesar la reserva (crear registro, enviar mail, etc.)
        // Por ahora, solo simulamos la acción
        return redirect()->back()->with('success', 'Hospedaje reservado correctamente.');
    }
}

