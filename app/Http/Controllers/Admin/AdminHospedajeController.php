<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HospedajeRequest;
use App\Models\Hospedaje;

class AdminHospedajeController extends Controller
{
    public function index()
    {
        $hospedajes = Hospedaje::all();

        return view('administracion.hospedaje', compact('hospedajes'));
    }

    public function create(HospedajeRequest $request)
    {
        try {
            // Crear el viaje
            Hospedaje::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Hospedaje creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el hospedaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(HospedajeRequest $request, Hospedaje $hospedaje)
    {

        try {
            $hospedaje->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Hospedaje actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el hospedaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Hospedaje $hospedaje)
    {
        try {
            $hospedaje->delete();


            return response()->json([
                'success' => true,
                'message' => 'Hospedaje eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el hospedaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
