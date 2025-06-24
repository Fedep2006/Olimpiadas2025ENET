<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Hospedaje;
use App\Models\Pago;
use App\Models\Paquete;
use App\Models\PaqueteContenido;
use App\Models\Viaje;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DetalleController extends Controller
{
    /**
     * Muestra la página de detalles para un ítem específico (vehículo o hospedaje).
     */
    public function show($tipo, $id)
    {
        $item = null;
        if ($tipo === 'vehiculo') {
            $item = Vehiculo::findOrFail($id);
        }
        elseif ($tipo === 'hospedaje') {
            $item = Hospedaje::findOrFail($id);
        }
        elseif ($tipo === 'viaje') {
            $item = Viaje::with('empresa')->findOrFail($id);
        }
        else {
            abort(404, 'Tipo de item no válido.');
        }

        return view('details', ['item' => $item, 'tipo' => $tipo]);
    }

    /**
     * Procesa y almacena una nueva reserva.
     */
    public function store(Request $request)
    {
        $rules = [
            'item_id' => 'required|integer',
            'item_type' => 'required|string|in:hospedaje,vehiculo,viaje',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'total_pagar' => 'required|numeric|min:0',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'card_number' => 'required|string|max:19',
            'card_expiry' => 'required|string|max:5',
            'card_cvc' => 'required|string|max:4',
        ];

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'date' => 'El campo :attribute no es una fecha válida.',
            'after_or_equal' => 'La fecha de fin debe ser posterior o igual a la fecha de inicio.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'min' => 'El campo :attribute debe ser al menos :min.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        DB::beginTransaction();
        try {
            // 1. Identificar el producto
            $itemType = $validated['item_type'];
            $itemId = $validated['item_id'];
            $item = null;
            if ($itemType === 'hospedaje') {
                $item = Hospedaje::findOrFail($itemId);
            } elseif ($itemType === 'vehiculo') {
                $item = Vehiculo::findOrFail($itemId);
            } elseif ($itemType === 'viaje') {
                $item = Viaje::findOrFail($itemId);
            }
            $itemName = $item->nombre ?? ($item->marca . ' ' . $item->modelo);

            // Calcular duración (la BDD espera un string)
            $fechaInicio = Carbon::parse($validated['fecha_inicio']);
            $fechaFin = Carbon::parse($validated['fecha_fin']);
            $duracion = $fechaFin->diffInDays($fechaInicio);
            $duracion = $duracion > 0 ? $duracion : 1;
            if ($itemType === 'vehiculo') {
                 $duracion = $fechaFin->diffInDays($fechaInicio) + 1;
            }
            $duracionString = $duracion . ($duracion > 1 ? ' días' : ' día');

            // 2. Crear un paquete virtual (con todos los campos obligatorios de la BDD)
            $paquete = Paquete::create([
                'nombre' => 'Reserva de ' . ucfirst($itemType) . ': ' . $itemName,
                'descripcion' => 'Paquete autogenerado para reserva individual.',
                'precio_total' => $validated['total_pagar'],
                'duracion' => $duracionString, // La BDD espera un string
                'ubicacion' => $item->ubicacion,
                'numero_paquete' => 'IND-' . strtoupper(Str::random(8)), // Campo obligatorio
                'hecho_por_usuario' => true,
                'activo' => false,
            ]);

            // 3. Asociar el contenido al paquete
            $contenido = new PaqueteContenido();
            $contenido->paquete_id = $paquete->id;
            $contenido->contenido()->associate($item);
            $contenido->save();

            // 4. Crear la reserva (con los campos correctos de la BDD)
            $reserva = Reserva::create([
                'usuario_id' => Auth::id(), // Columna correcta: usuario_id
                'paquete_id' => $paquete->id,
                'fecha_inicio' => $validated['fecha_inicio'],
                'fecha_fin' => $validated['fecha_fin'],
                'estado' => 'pendiente',
                'tipo_reserva' => $itemType === 'vehiculo' ? 'viaje' : $itemType,
                'precio_total' => $validated['total_pagar'],
                'codigo_reserva' => strtoupper(Str::random(8)), // Campo obligatorio
            ]);

            // 5. Crear el pago (con los campos correctos de la BDD)
            $expiryDate = explode('/', $validated['card_expiry']);
            $expiration_month = trim($expiryDate[0]);
            $expiration_year = trim($expiryDate[1]);
            if (strlen($expiration_year) == 2) {
                $expiration_year = '20' . $expiration_year;
            }

            $pago = Pago::create([
                'reserva_id' => $reserva->id, // Relación correcta
                'estado' => 'pendiente',
                'cardholder_name' => $validated['nombre'],
                'card_number' => $validated['card_number'],
                'expiration_month' => $expiration_month,
                'expiration_year' => $expiration_year,
                'cvv' => $validated['card_cvc'],
                'amount' => $validated['total_pagar'], // Columna correcta: amount
            ]);

            DB::commit();

            return redirect()->route('home')->with('success', '¡Tu reserva ha sido confirmada con éxito! Código de reserva: ' . $reserva->codigo_reserva);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un problema al procesar tu reserva. Por favor, inténtalo de nuevo. Detalle: ' . $e->getMessage())->withInput();
        }
    }
}
