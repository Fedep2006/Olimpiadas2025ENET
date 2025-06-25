<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservaRequest;
use App\Models\Pago;
use App\Models\Paquete;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\User;

class AdminReservasController extends Controller
{
    public function index(Request $request)
    {
        $query = Reserva::with(['paquete', 'pago', 'usuario']);

        // Aplicar búsqueda
        if ($request->filled('search_reserva')) {
            $search = $request->search_reserva;
            $query->where(function ($q) use ($search) {
                $q->where('codigo_reserva', 'like', "%{$search}%")
                    ->orWhereHas('paquete', function ($subQuery) use ($search) {
                        $subQuery->where('numero_paquete', 'like', "%{$search}%");
                    });
            });
        }
        if ($request->filled('search_usuario')) {
            $search = $request->search_usuario;
            $query->where(function ($q) use ($search) {
                $q->WhereHas('usuario', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }
        if ($request->filled('search_fecha_inicio')) {
            $search = $request->search_fecha_inicio;
            $query->whereDate('fecha_inicio', $search);
        }
        if ($request->filled('search_fecha_fin')) {
            $search = $request->search_fecha_fin;
            $query->whereDate('fecha_fin', $search);
        }
        if ($request->filled('search_precio_total')) {
            $search = $request->search_precio_total;
            $query->where('precio_total', 'like', "%{$search}%");
        }
        if ($request->filled('search_estado')) {
            $search = $request->search_estado;
            $query->where('estado', $search);
        }
        // Aplicar filtro de fecha
        if ($request->filled('search_registration_date')) {
            $date = $request->search_registration_date;
            $query->whereDate('created_at', $date);
        }

        // Ordenar por fecha de creación descendente
        $query->orderBy('created_at', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-reservas-contenido', compact('registros'))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} reservas"
            ]);
        }
        $usuarios = User::all();
        $paquetes = Paquete::all();
        $pagos = Pago::all();
        return view('administracion.reservas', compact(['registros', 'usuarios', 'paquetes', 'pagos']));
    }
    public function create(ReservaRequest $request)
    {
        try {
            // Crear la reserva
            Reserva::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Reserva creada exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(ReservaRequest $request, Reserva $reserva)
    {

        try {
            $reserva->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Reserva actualizada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Reserva $reserva)
    {
        try {
            $reserva->delete();


            return response()->json([
                'success' => true,
                'message' => 'Reserva eliminada exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
