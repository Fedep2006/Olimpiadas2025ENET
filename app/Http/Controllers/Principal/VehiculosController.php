<?php

namespace App\Http\Controllers\Principal;

use App\Models\Vehiculo;
use App\Models\ReservaVehiculo;
use App\Models\Pago;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VehiculosController extends Controller
{
    // Muestra el detalle de un vehículo
    public function show($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        
        // Buscar reservas activas para este vehículo y usuario
        $reservas = ReservaVehiculo::where('vehiculo_id', $vehiculo->id)
            ->where('user_id', Auth::id())
            ->whereIn('estado', ['pendiente', 'aceptado'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('detalles', compact('vehiculo', 'reservas'));
    }
    
    // Procesa la reserva de un vehículo
    public function reservar(Request $request, $id)
    {
        $request->validate([
            'fecha_retiro' => 'required|date|after_or_equal:today',
            'fecha_devolucion' => 'required|date|after_or_equal:fecha_retiro',
            'nombre_titular' => 'required|string|max:255',
            'numero_tarjeta' => 'required|string|size:16',
            'fecha_vencimiento' => 'required|date_format:m/y|after:today',
            'cvv' => 'required|string|size:3',
        ]);
        
        $vehiculo = Vehiculo::findOrFail($id);
        
        // Calcular el total de días y el monto total
        $fechaRetiro = Carbon::parse($request->fecha_retiro);
        $fechaDevolucion = Carbon::parse($request->fecha_devolucion);
        $dias = $fechaRetiro->diffInDays($fechaDevolucion) ?: 1; // Mínimo 1 día
        $montoTotal = $vehiculo->precio_por_dia * $dias;
        
        // Iniciar transacción
        DB::beginTransaction();
        
        try {
            // Crear el pago
            $pago = Pago::create([
                'monto' => $montoTotal,
                'moneda' => 'ARS',
                'metodo_pago' => 'tarjeta_credito',
                'estado' => 'pendiente',
                'fecha_pago' => now(),
                'tarjeta_ultimos_digitos' => substr($request->numero_tarjeta, -4),
                'tarjeta_marca' => $this->getCardBrand($request->numero_tarjeta),
                'nombre_titular' => $request->nombre_titular,
                'user_id' => Auth::id(),
                'detalles_adicionales' => 'Reserva de vehículo: ' . $vehiculo->marca . ' ' . $vehiculo->modelo,
            ]);
            
            // Crear la reserva
            $reserva = new ReservaVehiculo([
                'vehiculo_id' => $vehiculo->id,
                'user_id' => Auth::id(),
                'pago_id' => $pago->id,
                'tipo' => $vehiculo->tipo,
                'marca' => $vehiculo->marca,
                'modelo' => $vehiculo->modelo,
                'antiguedad' => $vehiculo->antiguedad,
                'patente' => $vehiculo->patente,
                'color' => $vehiculo->color,
                'capacidad_pasajeros' => $vehiculo->capacidad_pasajeros,
                'pais_id' => $vehiculo->pais_id,
                'provincia_id' => $vehiculo->provincia_id,
                'ciudad_id' => $vehiculo->ciudad_id,
                'ubicacion' => $vehiculo->ubicacion,
                'precio_por_dia' => $vehiculo->precio_por_dia,
                'fecha_retiro' => $request->fecha_retiro,
                'fecha_devolucion' => $request->fecha_devolucion,
                'estado' => 'pendiente',
                'notas' => 'Reserva creada el ' . now()->format('d/m/Y H:i:s'),
            ]);
            
            $reserva->save();
            
            // Aquí iría la lógica para procesar el pago con la pasarela de pago
            // Por ahora, simulamos un pago exitoso
            $pago->update([
                'estado' => 'aprobado',
                'referencia_pago' => 'PAY-' . strtoupper(uniqid()),
            ]);
            
            $reserva->update(['estado' => 'aceptado']);
            
            DB::commit();
            
            return redirect()->back()->with([
                'reserva_status' => 'success',
                'reserva_mensaje' => '¡Reserva realizada con éxito! Su número de reserva es: ' . $reserva->id,
                'reserva_numero' => $reserva->id,
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al procesar la reserva: ' . $e->getMessage());
            
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
