<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Hospedaje;
use App\Models\Vehiculo;
use App\Models\Paquete;
use App\Models\Viaje;
use App\Models\Reserva;
use App\Models\Pagos;
use App\Models\User;
use Carbon\Carbon;

use App\Mail\ReservaViajeEnviada;
use App\Mail\ReservaVehiculoEnviada;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    // Mostrar el carrito
    public function index(Request $request)
    {
        $carrito = session('carrito', []);
        return view('login.carrito', compact('carrito'));
    }

    // Agregar hospedaje al carrito
    public function addHospedaje(Request $request, $id)
    {
        $hospedaje = Hospedaje::findOrFail($id);
        $carrito = session('carrito', []);
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
                'imagen' => $hospedaje->imagen_principal ?? null,
                'descripcion' => $hospedaje->descripcion ?? null
            ];
        }
        
        session(['carrito' => $carrito]);
        return redirect()->route('carrito')->with('success', 'Hospedaje añadido al carrito.');
    }

    // Agregar vehículo al carrito
    public function addVehiculo(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $carrito = session('carrito', []);
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
                'imagen' => $vehiculo->imagen ?? null,
                'descripcion' => $vehiculo->descripcion ?? null
            ];
        }
        
        session(['carrito' => $carrito]);
        return redirect()->route('carrito')->with('success', 'Vehículo añadido al carrito.');
    }

    // Agregar paquete al carrito
    public function addPaquete(Request $request, $id)
    {
        $paquete = Paquete::findOrFail($id);
        $carrito = session('carrito', []);
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
                'imagen' => $paquete->imagen ?? null,
                'descripcion' => $paquete->descripcion ?? null
            ];
        }
        
        session(['carrito' => $carrito]);
        return redirect()->route('carrito')->with('success', 'Paquete añadido al carrito.');
    }

    // Agregar viaje al carrito
    public function addViaje(Request $request, $id)
    {
        $viaje = Viaje::findOrFail($id);
        $carrito = session('carrito', []);
        $key = 'viaje_' . $id;
        
        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += 1;
        } else {
            $carrito[$key] = [
                'id' => $viaje->id,
                'nombre' => $viaje->origen . ' - ' . $viaje->destino,
                'precio' => $viaje->precio_base,
                'tipo' => 'viaje',
                'cantidad' => 1,
                'imagen' => $viaje->imagen ?? null,
                'descripcion' => $viaje->descripcion ?? null
            ];
        }
        
        session(['carrito' => $carrito]);
        return redirect()->route('carrito')->with('success', 'Viaje añadido al carrito.');
    }

    // Actualizar cantidad de un item en el carrito
    public function updateCartItem(Request $request)
    {
        $carrito = session('carrito', []);
        $key = $request->input('key');
        $cantidad = $request->input('cantidad', 1);
        
        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad'] = max(1, $cantidad);
            session(['carrito' => $carrito]);
            return response()->json(['success' => true, 'carrito' => $carrito]);
        }
        
        return response()->json(['success' => false, 'message' => 'Item no encontrado']);
    }

    // Eliminar item del carrito
    public function removeFromCart(Request $request)
    {
        $carrito = session('carrito', []);
        $key = $request->input('key');
        
        if(isset($carrito[$key])) {
            unset($carrito[$key]);
            session(['carrito' => $carrito]);
            return response()->json(['success' => true, 'carrito' => $carrito]);
        }
        
        return response()->json(['success' => false, 'message' => 'Item no encontrado']);
    }

    // Vaciar carrito
    public function clearCart(Request $request)
    {
        session(['carrito' => []]);
        return response()->json(['success' => true]);
    }

    // Procesar compra del carrito
    public function checkout(Request $request)
    {
        // Validar datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'card_number' => 'required|string|max:19',
            'card_expiry' => 'required|string|max:5',
            'card_cvc' => 'required|string|max:4',
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El email debe ser una dirección válida.',
            'max' => 'El campo :attribute no debe exceder :max caracteres.',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para continuar.');
        }

        $carrito = session('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();
        
        try {
            $totalGeneral = 0;
            foreach ($carrito as $item) {
                $totalGeneral += $item['precio'] * $item['cantidad'];
            }

            // Crear el paquete temporal
            $paquete = Paquete::create([
                'usuario_id' => Auth::id(),
                'nombre' => 'Compra del ' . now()->format('d/m/Y'),
                'descripcion' => 'Paquete generado automáticamente para la compra de múltiples productos',
                'precio_total' => $totalGeneral,
                'estado' => 'pendiente',
                'hecho_por_usuario' => true,
                'activo' => false // Es un paquete temporal, no visible para otros usuarios
            ]);

            // Crear los contenidos del paquete y las reservas
            foreach ($carrito as $key => $item) {
                $tipo = $item['tipo'];
                $cantidad = $item['cantidad'];
                $modelClass = match($tipo) {
                    'hospedaje' => Hospedaje::class,
                    'vehiculo' => Vehiculo::class,
                    'viaje' => Viaje::class,
                    'paquete' => Paquete::class,
                    default => null
                };

                if (!$modelClass) {
                    throw new \Exception("Tipo de item no válido: {$tipo}");
                }

                // Agregar el item al paquete
                $paquete->contenidos()->create([
                    'contenido_type' => $modelClass,
                    'contenido_id' => $item['id']
                ]);

                // Crear la reserva
                $reserva = Reserva::create([
                    'usuario_id' => Auth::id(),
                    'paquete_id' => $paquete->id,
                    'reservable_type' => $modelClass,
                    'reservable_id' => $item['id'],
                    'fecha_inicio' => $tipo === 'viaje' ? 
                        $modelClass::find($item['id'])->fecha_salida : 
                        now()->addDays(7),
                    'fecha_fin' => $tipo === 'viaje' ? 
                        $modelClass::find($item['id'])->fecha_llegada : 
                        now()->addDays(10),
                    'estado' => 'pendiente',
                    'tipo_reserva' => 'paquete',
                    'precio_total' => $item['precio'] * $item['cantidad'],
                    'codigo_reserva' => $this->generarCodigoReserva()
                ]);

                // Crear el pago
                Pagos::create([
                    'reserva_id' => $reserva->id,
                    'amount' => $item['precio'] * $item['cantidad'],
                    'estado' => 'pendiente',
                    'cardholder_name' => $request->nombre,
                    'card_number' => substr($request->card_number, -4),
                    'expiration_month' => substr($request->card_expiry, 0, 2),
                    'expiration_year' => '20' . substr($request->card_expiry, -2),
                    'cvv' => '***'
                ]);


            }

            DB::commit();
            session(['carrito' => []]);

            // Total de reservas creadas en el paquete
            $totalReservas = $paquete->contenidos()->count();

            return redirect()->route('mis-compras')->with('success', 'Compra procesada exitosamente. Se han creado ' . $totalReservas . ' reservas.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('carrito')
                ->with('error', 'Hubo un error al procesar tu compra. Por favor, intenta nuevamente.');
        }
    }

    // Generar código único de reserva
    private function generarCodigoReserva()
    {
        do {
            $codigo = strtoupper(substr(md5(uniqid()), 0, 8));
        } while (Reserva::where('codigo_reserva', $codigo)->exists());
        
        return $codigo;
    }
}
