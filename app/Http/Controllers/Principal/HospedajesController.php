<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use App\Models\Hospedaje;
use App\Models\Paquete;
use App\Models\PaqueteContenido;
use App\Models\Reserva;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HospedajesController extends Controller
{
    public function show($id)
    {
        $item = Hospedaje::with(['empresa', 'pais', 'provincia', 'ciudad'])->findOrFail($id);
        $tipo = 'hospedaje';
        return view('details', compact('item', 'tipo'));
    }

    public function storeReserva(Request $request)
    {
        // Validación manual de los datos de entrada
        $validatedData = $request->validate([
            'hospedaje_id' => 'required|exists:hospedajes,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'noches' => 'required|integer|min:1',
            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:19',
            'expiration_month' => 'required|string|max:2',
            'expiration_year' => 'required|string|max:4',
            'cvv' => 'required|string|max:4',
        ]);

        // Iniciar una transacción para asegurar la integridad de los datos
        DB::beginTransaction();

        try {
            // 1. Encontrar el hospedaje
            $hospedaje = Hospedaje::findOrFail($validatedData['hospedaje_id']);

            // 2. Crear un paquete dinámico para la reserva del hospedaje
            $paquete = Paquete::create([
                'nombre' => 'Reserva de Hospedaje: ' . $hospedaje->nombre,
                'descripcion' => 'Paquete generado automáticamente para la reserva del hospedaje ' . $hospedaje->nombre . ' del ' . $validatedData['fecha_inicio'] . ' al ' . $validatedData['fecha_fin'],
                'precio' => $hospedaje->precio_por_noche * $validatedData['noches'],
                'activo' => false, // Es un paquete dinámico, no visible para otros usuarios
            ]);

            // 3. Vincular el hospedaje al paquete
            PaqueteContenido::create([
                'paquete_id' => $paquete->id,
                'contenido_id' => $hospedaje->id,
                'contenido_type' => Hospedaje::class,
            ]);

            // 4. Crear la reserva
            $reserva = Reserva::create([
                'usuario_id' => auth()->id(),
                'paquete_id' => $paquete->id,
                'fecha_inicio' => $validatedData['fecha_inicio'],
                'fecha_fin' => $validatedData['fecha_fin'],
                'precio_total' => $paquete->precio,
                'codigo_reserva' => strtoupper(Str::random(8)),
                'tipo_reserva'   => 'hospedaje',
                'estado' => 'pendiente',
            ]);

            // 5. Crear el registro del pago
            $pago = Pago::create([
                'reserva_id' => $reserva->id,
                'cardholder_name' => $validatedData['cardholder_name'],
                'card_number' => $validatedData['card_number'], // Considera encriptar esto
                'expiration_month' => $validatedData['expiration_month'],
                'expiration_year' => $validatedData['expiration_year'],
                'cvv' => $validatedData['cvv'], // Considera encriptar esto
                'amount' => $reserva->precio_total,
                'estado' => 'pendiente',
            ]);

            // Si todo fue bien, confirmar la transacción
            DB::commit();

            return redirect()->route('ruta.a.confirmacion')->with('success', '¡Tu reserva ha sido creada con éxito!');

        } catch (\Exception $e) {
            // Si algo falla, revertir todos los cambios
            DB::rollBack();

            // Registrar el error y notificar al usuario
            Log::error('Error al crear reserva de hospedaje: ' . $e->getMessage());
            return back()->withErrors(['error' => 'No se pudo procesar tu reserva. Por favor, intenta de nuevo.']);
        }
    }
}
