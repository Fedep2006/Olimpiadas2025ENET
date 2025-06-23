<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use App\Models\Hospedaje;
use App\Models\Viaje;
use App\Models\Vehiculo;
use App\Models\Paquete;

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

    // Actualizar cantidad de un producto en el carrito
    public function updateCartItem(\Illuminate\Http\Request $request)
    {
        $carrito = session()->get('carrito', []);
        $key = $request->input('key');
        $cantidad = $request->input('cantidad', 1);
        
        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad'] = max(1, $cantidad);
            session(['carrito' => $carrito]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    // Añadir hospedaje al carrito
    public function addHospedajeToCart($id)
    {
        $hospedaje = Hospedaje::findOrFail($id);
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
                'cantidad' => 1,
                'descripcion' => $hospedaje->descripcion,
                'ubicacion' => $hospedaje->ciudad,
                'imagen' => null // Puedes agregar campo de imagen si lo necesitas
            ];
        }
        
        session(['carrito' => $carrito]);
        return redirect()->route('carrito')->with('success', 'Hospedaje añadido al carrito.');
    }

    // Añadir viaje al carrito
    public function addViajeToCart($id)
    {
        $viaje = Viaje::findOrFail($id);
        $carrito = session()->get('carrito', []);
        $key = 'viaje_' . $id;
        
        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += 1;
        } else {
            $carrito[$key] = [
                'id' => $viaje->id,
                'nombre' => $viaje->nombre,
                'precio' => $viaje->precio_base,
                'tipo' => 'viaje',
                'cantidad' => 1,
                'descripcion' => $viaje->origen . ' → ' . $viaje->destino,
                'fecha_salida' => $viaje->fecha_salida,
                'imagen' => null
            ];
        }
        
        session(['carrito' => $carrito]);
        return redirect()->route('carrito')->with('success', 'Viaje añadido al carrito.');
    }

    // Añadir vehículo al carrito
    public function addVehiculoToCart($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $carrito = session()->get('carrito', []);
        $key = 'vehiculo_' . $id;
        
        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += 1;
        } else {
            $carrito[$key] = [
                'id' => $vehiculo->id,
                'nombre' => $vehiculo->marca . ' ' . $vehiculo->modelo,
                'precio' => $vehiculo->precio_por_dia,
                'tipo' => 'vehiculo',
                'cantidad' => 1,
                'descripcion' => $vehiculo->tipo . ' - ' . $vehiculo->ubicacion,
                'imagen' => null
            ];
        }
        
        session(['carrito' => $carrito]);
        return redirect()->route('carrito')->with('success', 'Vehículo añadido al carrito.');
    }

    // Añadir paquete al carrito
    public function addPaqueteToCart($id)
    {
        $paquete = Paquete::findOrFail($id);
        $carrito = session()->get('carrito', []);
        $key = 'paquete_' . $id;
        
        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += 1;
        } else {
            $carrito[$key] = [
                'id' => $paquete->id,
                'nombre' => $paquete->nombre,
                'precio' => $paquete->precio_total,
                'tipo' => 'paquete',
                'cantidad' => 1,
                'descripcion' => $paquete->descripcion,
                'imagen' => null
            ];
        }
        
        session(['carrito' => $carrito]);
        return redirect()->route('carrito')->with('success', 'Paquete añadido al carrito.');
    }

    // Vaciar carrito
    public function clearCart()
    {
        session()->forget('carrito');
        return response()->json(['success' => true]);
    }

    // Reservar hospedaje directamente
    public function reservarHospedaje($id)
    {
        // Aquí deberías procesar la reserva (crear registro, enviar mail, etc.)
        // Por ahora, solo simulamos la acción
        return redirect()->back()->with('success', 'Hospedaje reservado correctamente.');
    }
}

