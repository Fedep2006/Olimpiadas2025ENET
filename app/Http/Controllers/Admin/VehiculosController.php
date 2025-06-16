<?php

namespace App\Http\Controllers\Admin;
use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class VehiculosController extends Controller
{
    // Reservar vehículo para usuario autenticado
    public function reservar($id, \Illuminate\Http\Request $request)
    {
        // Si no está autenticado, redirigir a login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $vehiculo = \App\Models\Vehiculo::findOrFail($id);

        // Validar datos básicos
        $validated = $request->validate([
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'cantidad' => 'required|integer|min:1',
            // Los campos de pago se validarán luego
        ]);

        // Calcular fecha_fin automáticamente
        $fecha_inicio = new \DateTime($validated['fecha_inicio']);
        $fecha_fin = clone $fecha_inicio;
        $fecha_fin->modify('+' . $validated['cantidad'] . ' days');

        // Si no se enviaron datos de pago, mostrar formulario de pago
        if (!$request->has(['cardholder_name', 'card_number', 'expiration_month', 'expiration_year', 'cvv'])) {
            // Guardar temporalmente los datos en sesión o reenviar con old()
            return redirect()->back()->withInput()->with('reserva_status', 'Por favor, completa los datos de la tarjeta para finalizar la reserva.');
        }

        // Validar datos de pago
        $request->validate([
            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|string|digits_between:13,19',
            'expiration_month' => 'required|digits:2',
            'expiration_year' => 'required|digits:4',
            'cvv' => 'required|digits_between:3,4',
        ]);

        // Crear la reserva y el pago en una transacción
        $reserva = null;
        $pago = null;
        \DB::transaction(function() use ($vehiculo, $validated, $fecha_inicio, $fecha_fin, $request, &$reserva, &$pago) {
            $reserva = new \App\Models\Reserva();
            $reserva->usuario_id = auth()->id();
            $reserva->tipo = 'vehiculo';
            $reserva->servicio_id = $vehiculo->id;
            $reserva->fecha_inicio = $fecha_inicio->format('Y-m-d');
            $reserva->fecha_fin = $fecha_fin->format('Y-m-d');
            $reserva->ubicacion = $vehiculo->ubicacion;
            $reserva->estado = 'pendiente'; // Siempre pendiente
            $reserva->personas_id = json_encode([]); // Ajustar según lógica
            $reserva->habitaciones_id = null;
            $reserva->precio_total = $vehiculo->precio_por_dia * $validated['cantidad'];
            $reserva->codigo_reserva = strtoupper(substr(md5(uniqid()), 0, 8));
            $reserva->observaciones = null;
            $reserva->metodo_pago = 'tarjeta';
            $reserva->pagado = false;
            $reserva->fecha_pago = null;
            $reserva->save();

            $pago = new \App\Models\Pagos();
            $pago->vehiculo_id = $vehiculo->id;
            $pago->reserva_id = $reserva->id;
            $pago->cardholder_name = $request->cardholder_name;
            $pago->card_number = $request->card_number;
            $pago->expiration_month = $request->expiration_month;
            $pago->expiration_year = $request->expiration_year;
            $pago->cvv = $request->cvv;
            $pago->amount = $reserva->precio_total;
            $pago->estado = 'pendiente';
            $pago->save();
        });

        // Enviar email al usuario
        \Mail::send('emails.reserva_enviada', [
            'vehiculo' => $vehiculo,
            'reserva' => $reserva,
        ], function($message) use ($vehiculo) {
            $message->to(auth()->user()->email)
                ->subject('Reserva enviada - Frategar');
        });

        return redirect()->back()->with('reserva_status', 'Reserva enviada correctamente, debe esperar a la confirmación del administrador');
    }
    // Muestra el detalle de un vehículo
    public function show($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        // Buscar la reserva activa para este vehículo y usuario
        $reserva = \App\Models\Reserva::where('tipo', 'vehiculo')
            ->where('servicio_id', $vehiculo->id)
            ->where('usuario_id', auth()->id())
            ->latest()
            ->first();
        return view('detalles', compact('vehiculo', 'reserva'));
    }
    public function index(){
        $vehiculo = Vehiculo::all();
        return view("administracion.vehiculos" ,compact("vehiculo"));

    }

    public function AñadirVehiculo(Request $request){

        $Vehiculo = new Vehiculo();
        $Vehiculo->id = $request->id;
        $Vehiculo->tipo = $request->tipo;
        $Vehiculo->marca = $request->marca;
        $Vehiculo->modelo = $request->modelo;
        $Vehiculo->antiguedad = $request->antiguedad;
        $Vehiculo->patente = $request->patente;
        $Vehiculo->color = $request->color;
        $Vehiculo->capacidad_pasajeros = $request->capacidad_pasajeros;
        $Vehiculo->ubicacion = $request->ubicacion;
        $Vehiculo->precio_por_dia = $request->precio_por_dia;
        $Vehiculo->disponible = $request->disponible;
        $Vehiculo->imagenes = $request->imagenes;
        $Vehiculo->caracteristicas = $request->caracteristicas;
        $Vehiculo->observaciones = $request->observaciones;
        $Vehiculo->save();
        return redirect()->route("administracion.vehiculos")->with("success", "Vehiculo agregado correctamente");
    }

    public function EditarVehiculo(Request $request){

       $vehiculo = Vehiculo::find($request->id);
       $vehiculo->tipo = $request->tipo;
       $vehiculo->marca = $request->marca;
       $vehiculo->modelo = $request->modelo;
       $vehiculo->antiguedad = $request->antiguedad;
       $vehiculo->patente = $request->patente;
       $vehiculo->color = $request->color;
       $vehiculo->capacidad_pasajeros = $request->capacidad_pasajeros;
       $vehiculo->ubicacion = $request->ubicacion;
       $vehiculo->precio_por_dia = $request->precio_por_dia;
       $vehiculo->disponible = $request->disponible;
       $vehiculo->imagenes = $request->imagenes;
       $vehiculo->caracteristicas = $request->caracteristicas;
       $vehiculo->observaciones = $request->observaciones;
       $vehiculo->save();
       return redirect()->route("administracion.vehiculos")->with("success", "Vehiculo actualizado correctamente");
    }

    public function EliminarVehiculo($id){

        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return redirect()->route("administracion.vehiculos")->with("error", "Vehiculo no encontrado");
        }
        $vehiculo->delete();
        return redirect()->route("administracion.vehiculos")->with("success", "Vehiculo eliminado correctamente");
    }

}