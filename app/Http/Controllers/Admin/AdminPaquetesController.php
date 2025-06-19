<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaqueteRequest;
use App\Models\Paquete;

class AdminPaquetesController extends Controller
{
    public function index()
    {
        $paquetes = Paquete::all();
        return view("administracion.paquetes", compact("paquetes"));
    }

    public function create(PaqueteRequest $request)
    {
        try {
            // Crear el viaje
            Paquete::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Paquete creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el paquete',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(PaqueteRequest $request, Paquete $paquete)
    {

        try {
            $paquete->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Paquete actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el paquete',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Paquete $paquete)
    {
        try {
            $paquete->delete();


            return response()->json([
                'success' => true,
                'message' => 'Paquete eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el paquete',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
