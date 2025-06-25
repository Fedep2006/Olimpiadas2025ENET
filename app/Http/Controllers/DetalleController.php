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
        elseif ($tipo === 'paquete') {
            $item = Paquete::where('id', $id)
                ->where('hecho_por_usuario', '!=', 1)
                ->where('activo', 1)
                ->firstOrFail();
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
            'item_type' => 'required|string|in:hospedaje,vehiculo,viaje,paquete',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required_unless:item_type,viaje,paquete|nullable|date|after_or_equal:fecha_inicio',
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
            } elseif ($itemType === 'paquete') {
                $item = Paquete::findOrFail($itemId);
            }

            // 2. Determinar si la reserva debe asociarse a un paquete existente
            $paqueteId = null;
            if ($itemType === 'paquete') {
                // Si es un paquete existente, lo asociamos directamente.
                $paqueteId = $item->id;
            }

            // 3. Crear la reserva (polimórfica) y asociarla si corresponde
            $reservaData = [
                'usuario_id'      => Auth::id(),
                'paquete_id'      => $paqueteId, // Puede ser null para hospedaje/vehículo/viaje
                'reservable_id'   => $item->id,
                'reservable_type' => get_class($item),
                'fecha_inicio'    => $validated['fecha_inicio'],
                'fecha_fin'       => $validated['fecha_fin'],
                'estado'          => 'pendiente',
                'tipo_reserva'    => $itemType, // 'paquete', 'hospedaje', 'vehiculo' o 'viaje'
                'precio_total'    => $validated['total_pagar'],
                'codigo_reserva'  => strtoupper(Str::random(8)),
            ];

            // Para viajes, la fecha_fin se establece desde el modelo para garantizar la consistencia.
            // Si es un viaje de solo ida (fecha_llegada es null), se usa la fecha de inicio.
            if ($itemType === 'viaje') {
                $reservaData['fecha_fin'] = $item->fecha_llegada ?? $reservaData['fecha_inicio'];
            }

            $reserva = Reserva::create($reservaData);

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

            return redirect()->route('mis-compras')->with('success', '¡Reserva enviada con éxito! En breve recibirás un email con los detalles.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un problema al procesar tu reserva. Por favor, inténtalo de nuevo. Detalle: ' . $e->getMessage())->withInput();
        }
    }
}
