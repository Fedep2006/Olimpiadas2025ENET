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
        $query = Reserva::query();

        // Aplicar búsqueda
        if ($request->filled('search_usuario')) {
            $search = $request->search_usuario;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('search_nivel')) {
            $search = $request->search_nivel;
            $query->Where('nivel', $search);
        }

        // Aplicar filtro de fecha
        if ($request->filled('search_registration_date')) {
            $date = $request->search_registration_date;
            $query->whereDate('created_at', $date);
        }

        // Ordenar por fecha de creación descendente
        $query->whereHas('pago')
            ->whereHas('paquete')
            ->whereHas('usuario')
            ->select(['id', 'usuario_id', 'paquete_id', 'fecha_inicio', 'fecha_fin', 'estado', 'precio_total', 'codigo_reserva', 'created_at'])->orderBy('created_at', 'desc');

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
