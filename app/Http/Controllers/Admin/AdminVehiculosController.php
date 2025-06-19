<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculoRequest;
use Illuminate\Support\Facades\Auth;

class AdminVehiculosController extends Controller
{

    public function index()
    {
        $vehiculo = Vehiculo::all();
        return view("administracion.vehiculos", compact("vehiculo"));
    }

    public function create(VehiculoRequest $request)
    {
        try {
            // Crear el viaje
            Vehiculo::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Vehiculo creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el vehiculo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(VehiculoRequest $request, Vehiculo $vehiculo)
    {

        try {
            $vehiculo->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Vehiculo actualizado exitosamente',
                'vehiculo' => $vehiculo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el vehiculo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Vehiculo $vehiculo)
    {
        try {
            $vehiculo->delete();


            return response()->json([
                'message' => 'Vehiculo eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error al eliminar el vehiculo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
