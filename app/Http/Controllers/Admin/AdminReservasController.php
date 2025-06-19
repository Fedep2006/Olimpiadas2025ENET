<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaRequest;
use App\Http\Requests\ReservaRequest;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Reserva;

class AdminReservasController extends Controller
{
    public function index()
    {
        $reservas = Reserva::all();
        return view("administracion.reservas", compact("reservas"));
    }
    public function create(ReservaRequest $request)
    {
        try {
            // Crear el viaje
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
                'message' => 'Reserva actualizada exitosamente',
                'reserva' => $reserva
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
                'message' => 'Reserva eliminada exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error al eliminar la reserva',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
