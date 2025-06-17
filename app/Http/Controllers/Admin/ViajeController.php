<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ViajeController extends Controller
{
    public function index(Request $request)
    {
        $query = Viaje::query();

        // Aplicar búsqueda por nombre o email del usuario
        if ($request->filled('search_empleado')) {
            $search = $request->search_empleado;
            $query->whereHas('usuario', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Aplicar búsqueda por ID del empleado
        if ($request->filled('search_id')) {
            $search = $request->search_id;
            $query->where('id', $search);
        }

        if ($request->filled('search_puesto')) {
            $search = $request->search_puesto;
            $query->where('puesto', 'like', "%{$search}%");
        }

        if ($request->filled('search_salario')) {
            $search = $request->search_salario;
            $query->where('salario', $search);
        }

        if ($request->filled('search_estado')) {
            $search = $request->search_estado;
            $query->where('estado', $search);
        }

        // Aplicar filtro de fecha
        if ($request->filled('search_hiring_date')) {
            $date = $request->search_hiring_date;
            $query->whereDate('fecha_contratacion', $date);
        }

        // Aplicar todas las condiciones y obtener resultados
        $registros = $query->select(['id', 'nombre', 'tipo', 'origen', 'destino', 'fecha_salida', 'fecha_llegada', 'empresa', 'numero_viaje', 'capacidad_total', 'asientos_disponibles', 'precio_base', 'clases', 'descripcion', 'activo'])
            ->orderBy('fecha_contratacion', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Respuesta AJAX
        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-viajes-contenido', compact(['registros']))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} viajes"
            ]);
        }

        return view('administracion.viajes', compact('registros'));
    }
    public function crear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required|integer|exists:users,id',
            'puesto' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date|before_or_equal:today',
            'salario' => 'required|string|max:255',
            'estado' => 'nullable|string|in:activo,inactivo,vacaciones,licencia',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            // Crear el viaje
            Viaje::create([
                'id' => $request->usuario_id,
                'usuario_id' => $request->usuario_id,
                'puesto' => $request->puesto,
                'nivel' => "0",
                'fecha_contratacion' => $request->fecha_contratacion,
                'salario' => $request->salario,
                'estado' => $request->estado ?? 'activo',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Viaje creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Error al crear el Viaje",
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show($id)
    {
        $viaje = Viaje::findOrFail($id);
        if ($viaje->fecha_salida) $viaje->fecha_salida = $viaje->fecha_salida instanceof \Carbon\Carbon ? $viaje->fecha_salida->format('Y-m-d\TH:i') : $viaje->fecha_salida;
        if ($viaje->fecha_llegada) $viaje->fecha_llegada = $viaje->fecha_llegada instanceof \Carbon\Carbon ? $viaje->fecha_llegada->format('Y-m-d\TH:i') : $viaje->fecha_llegada;

        $reserva = null;
        if (auth()->check()) {
            $reserva = \App\Models\Reserva::where('tipo', 'viaje')
                ->where('servicio_id', $viaje->id)
                ->where('usuario_id', auth()->id())
                ->latest()
                ->first();
        }
        return view('detalles_viajes', compact('viaje', 'reserva'));
    }

    public function reservasViaje(Request $request, $viajeId)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
            'pasajeros' => 'required|json',
            'cardholder_name' => 'required|string|max:255',
            'card_number' => 'required|digits_between:13,19',
            'expiration_month' => 'required|digits:2',
            'expiration_year' => 'required|digits:4',
            'cvv' => 'required|digits_between:3,4',
        ]);

        $viaje = Viaje::findOrFail($viajeId);
        $cantidad = $request->input('cantidad');
        $pasajeros = json_decode($request->input('pasajeros'), true);
        $precio_total = $viaje->precio_base * $cantidad;

        DB::beginTransaction();
        try {
            $reserva = new \App\Models\ReservaViaje();
            $reserva->usuario_id = auth()->id();
            $reserva->viaje_id = $viaje->id;
            $reserva->cantidad = $cantidad;
            $reserva->pasajeros = $pasajeros;
            $reserva->precio_total = $precio_total;
            $reserva->estado = 'pendiente';
            $reserva->metodo_pago = 'tarjeta';
            $reserva->pagado = true;
            $reserva->fecha_pago = now();
            $reserva->observaciones = null;
            $reserva->save();

            $pago = new \App\Models\Pagos();
            $pago->reserva_viaje_id = $reserva->id;
            $pago->cardholder_name = $request->input('cardholder_name');
            $pago->card_number = $request->input('card_number');
            $pago->expiration_month = $request->input('expiration_month');
            $pago->expiration_year = $request->input('expiration_year');
            $pago->cvv = $request->input('cvv');
            $pago->amount = $precio_total;
            $pago->estado = 'pendiente';
            $pago->save();

            // Enviar email de confirmación
            \Mail::to(auth()->user()->email)->send(new \App\Mail\ReservaViajeEnviada($viaje, $reserva));

            DB::commit();
            return redirect()->route('viajes.show', $viaje->id)->with('status', 'Reserva y pago realizados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al procesar la reserva: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        try {
            $viaje = Viaje::findOrFail($id);
            
            // Formatear fechas para los campos datetime-local
            $viaje->fecha_salida = $viaje->fecha_salida->format('Y-m-d\TH:i');
            $viaje->fecha_llegada = $viaje->fecha_llegada->format('Y-m-d\TH:i');
            
            // Asegurarse de que los campos de array estén en el formato correcto
            if (!is_array($viaje->clases) && !empty($viaje->clases)) {
                $viaje->clases = json_decode($viaje->clases, true) ?: [];
            }
            
            if (!is_array($viaje->servicios) && !empty($viaje->servicios)) {
                $viaje->servicios = json_decode($viaje->servicios, true) ?: [];
            }
            
            return response()->json($viaje);
        } catch (\Exception $e) {
            Log::error('Error al obtener viaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el viaje: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'tipo' => 'required|string|max:50',
                'origen' => 'required|string|max:100',
                'destino' => 'required|string|max:100',
                'fecha_salida' => 'required|date',
                'fecha_llegada' => 'required|date|after_or_equal:fecha_salida',
                'empresa' => 'required|string|max:100',
                'numero_viaje' => 'required|string|max:50',
                'capacidad_total' => 'required|integer|min:1',
                'asientos_disponibles' => 'required|integer|min:0',
                'precio_base' => 'required|numeric|min:0',
                'descripcion' => 'nullable|string',
                'observaciones' => 'nullable|string',
                'clases' => 'nullable|array',
                'servicios' => 'nullable|array',
                'activo' => 'required|boolean'
            ]);

            $viaje = Viaje::findOrFail($id);

            $validated['activo'] = filter_var($validated['activo'], FILTER_VALIDATE_BOOLEAN);
            if (isset($validated['clases'])) {
                $validated['clases'] = json_encode($validated['clases']);
            }
            if (isset($validated['servicios'])) {
                $validated['servicios'] = json_encode($validated['servicios']);
            }

            $viaje->update($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Viaje actualizado exitosamente',
                'data' => $viaje
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el viaje: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Viaje $viaje)
    {
        try {
            $viaje->delete();

            return response()->json([
                'message' => 'Viaje eliminado exitosamente'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error al eliminar el viaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
