<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use App\Models\Hospedaje;
use App\Models\Pago;
use App\Models\ReservaHospedaje;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservasController extends Controller {
    // Eliminar producto del carrito por clave
    public function removeFromCart(Request $request)
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
                'imagen' => $hospedaje->imagen_principal
            ];
        }
        session(['carrito' => $carrito]);
        return redirect('/login/carrito')->with('success', 'Hospedaje añadido al carrito.');
    }

    public function reservarHospedaje(Request $request, $id)
    {
        $request->validate([
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'cantidad_personas' => 'required|integer|min:1',
            'nombre_titular' => 'required|string|max:255',
            'numero_tarjeta' => 'required|string|size:16',
            'fecha_vencimiento' => 'required|date_format:m/y|after:today',
            'cvv' => 'required|string|size:3',
        ]);
        
        $hospedaje = Hospedaje::findOrFail($id);
        
        // Calcular el total de noches y el monto total
        $fechaEntrada = Carbon::parse($request->fecha_entrada);
        $fechaSalida = Carbon::parse($request->fecha_salida);
        $noches = $fechaEntrada->diffInDays($fechaSalida);
        $montoTotal = $hospedaje->precio_por_noche * $noches * $request->cantidad_personas;
        
        // Iniciar transacción
        DB::beginTransaction();
        
        try {
            // Crear el pago
            $pago = Pago::create([
                'monto' => $montoTotal,
                'moneda' => 'ARS',
                'metodo_pago' => 'tarjeta_credito',
                'estado' => 'aprobado',
                'fecha_pago' => now(),
                'tarjeta_ultimos_digitos' => substr($request->numero_tarjeta, -4),
                'tarjeta_marca' => $this->getCardBrand($request->numero_tarjeta),
                'nombre_titular' => $request->nombre_titular,
                'user_id' => Auth::id(),
                'detalles_adicionales' => 'Reserva de hospedaje: ' . $hospedaje->nombre,
            ]);
            
            // Crear la reserva
            $reserva = new ReservaHospedaje([
                'hospedaje_id' => $hospedaje->id,
                'user_id' => Auth::id(),
                'pago_id' => $pago->id,
                'fecha_entrada' => $request->fecha_entrada,
                'fecha_salida' => $request->fecha_salida,
                'cantidad_personas' => $request->cantidad_personas,
                'precio_por_noche' => $hospedaje->precio_por_noche,
                'monto_total' => $montoTotal,
                'estado' => 'confirmada',
                'notas' => 'Reserva creada el ' . now()->format('d/m/Y H:i:s'),
            ]);
            
            $reserva->save();
            
            DB::commit();
            
            // Limpiar el carrito si existe este ítem
            $carrito = session()->get('carrito', []);
            $key = 'hospedaje_' . $id;
            if(isset($carrito[$key])) {
                unset($carrito[$key]);
                session(['carrito' => $carrito]);
            }
            
            return redirect()->route('mis-reservas')->with([
                'reserva_status' => 'success',
                'reserva_mensaje' => '¡Reserva de hospedaje realizada con éxito! Su número de reserva es: ' . $reserva->id,
                'reserva_numero' => $reserva->id,
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar la reserva de hospedaje: ' . $e->getMessage());
            
            return redirect()->back()->with([
                'reserva_status' => 'error',
                'reserva_mensaje' => 'Ocurrió un error al procesar su reserva. Por favor, intente nuevamente.'
            ])->withInput();
        }
    }
    
    // Método auxiliar para determinar la marca de la tarjeta
    private function getCardBrand($cardNumber)
    {
        $cardNumber = preg_replace('/\D/', '', $cardNumber);
        
        if (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $cardNumber)) {
            return 'Visa';
        } elseif (preg_match('/^5[1-5][0-9]{14}$/', $cardNumber)) {
            return 'MasterCard';
        } elseif (preg_match('/^3[47][0-9]{13}$/', $cardNumber)) {
            return 'American Express';
        } elseif (preg_match('/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/', $cardNumber)) {
            return 'Diners Club';
        } elseif (preg_match('/^6(?:011|5[0-9]{2})[0-9]{12}$/', $cardNumber)) {
            return 'Discover';
        } else {
            return 'Otra';
        }
    }
}

