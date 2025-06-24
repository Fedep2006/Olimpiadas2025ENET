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
use App\Mail\ReservaCreada;
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
            $reservasCreadas = [];

            foreach ($carrito as $key => $item) {
                $tipo = $item['tipo'];
                $cantidad = $item['cantidad'];
                $precioUnitario = $item['precio'];
                $subtotal = $precioUnitario * $cantidad;
                $totalGeneral += $subtotal;

                switch ($tipo) {
                    case 'hospedaje':
                        $reserva = Reserva::create([
                            'usuario_id' => Auth::id(),
                            'paquete_id' => null,
                            'fecha_inicio' => now()->addDays(7),
                            'fecha_fin' => now()->addDays(10),
                            'estado' => 'confirmada',
                            'precio_total' => $subtotal,
                            'codigo_reserva' => $this->generarCodigoReserva(),
                            'tipo_reserva' => 'hospedaje',
                        ]);
                        
                        // Crear pago para esta reserva
                        $pago = Pagos::create([
                            'reserva_id' => $reserva->id,
                            'amount' => $subtotal,
                            'estado' => 'aprobado',
                            'cardholder_name' => Auth::user()->name,
                            'card_number' => '****',
                            'expiration_month' => '12',
                            'expiration_year' => '2025',
                            'cvv' => '***',
                        ]);
                        break;

                    case 'vehiculo':
                        $reserva = Reserva::create([
                            'usuario_id' => Auth::id(),
                            'paquete_id' => null,
                            'fecha_inicio' => now()->addDays(7),
                            'fecha_fin' => now()->addDays(10),
                            'estado' => 'confirmada',
                            'precio_total' => $subtotal,
                            'codigo_reserva' => $this->generarCodigoReserva(),
                            'tipo_reserva' => 'vehiculo',
                        ]);
                        
                        // Crear pago para esta reserva
                        $pago = Pagos::create([
                            'reserva_id' => $reserva->id,
                            'amount' => $subtotal,
                            'estado' => 'aprobado',
                            'cardholder_name' => Auth::user()->name,
                            'card_number' => '****',
                            'expiration_month' => '12',
                            'expiration_year' => '2025',
                            'cvv' => '***',
                        ]);
                        break;

                    case 'paquete':
                        $reserva = Reserva::create([
                            'usuario_id' => Auth::id(),
                            'paquete_id' => $item['id'],
                            'fecha_inicio' => now(),
                            'fecha_fin' => now()->addDays(7),
                            'estado' => 'confirmada',
                            'precio_total' => $subtotal,
                            'codigo_reserva' => $this->generarCodigoReserva(),
                            'tipo_reserva' => 'paquete',
                        ]);
                        
                        // Crear pago para esta reserva
                        $pago = Pagos::create([
                            'reserva_id' => $reserva->id,
                            'amount' => $subtotal,
                            'estado' => 'aprobado',
                            'cardholder_name' => Auth::user()->name,
                            'card_number' => '****',
                            'expiration_month' => '12',
                            'expiration_year' => '2025',
                            'cvv' => '***',
                        ]);
                        break;

                    case 'viaje':
                        $viaje = Viaje::findOrFail($item['id']);
                        $reserva = Reserva::create([
                            'usuario_id' => Auth::id(),
                            'reservable_id' => $viaje->id,
                            'reservable_type' => Viaje::class,
                            'fecha_inicio' => $viaje->fecha_salida,
                            'fecha_fin' => $viaje->fecha_llegada,
                            'estado' => 'confirmada',
                            'precio_total' => $subtotal,
                            'codigo_reserva' => $this->generarCodigoReserva(),
                            'tipo_reserva' => 'viaje',
                        ]);
                        
                        // Crear pago para esta reserva
                        $pago = Pagos::create([
                            'reserva_id' => $reserva->id,
                            'amount' => $subtotal,
                            'estado' => 'aprobado',
                            'cardholder_name' => Auth::user()->name,
                            'card_number' => '****',
                            'expiration_month' => '12',
                            'expiration_year' => '2025',
                            'cvv' => '***',
                        ]);
                        break;
                }

                $reservasCreadas[] = $reserva;
            }

            // Limpiar carrito
            session(['carrito' => []]);

            DB::commit();

            // Enviar correo de confirmación
            $user = Auth::user();
            Mail::to($user->email)->send(new ReservaCreada($user, $reservasCreadas));

            return redirect()->route('mis-compras')->with('success', 'Compra procesada exitosamente. Se han creado ' . count($reservasCreadas) . ' reservas.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('carrito')->with('error', 'Error al procesar la compra: ' . $e->getMessage());
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
