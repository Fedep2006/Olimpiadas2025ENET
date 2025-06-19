<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Http\Request;
use App\Models\Empresa;

class AdminEmpresasController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view("administracion.empresas", compact("empresas"));
    }

    public function create(EmpresaRequest $request)
    {
        try {
            // Crear el viaje
            Empresa::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Empresa creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(EmpresaRequest $request, Empresa $empresa)
    {

        try {
            $empresa->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Empresa actualizada exitosamente',
                'empresa' => $empresa
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Empresa $empresa)
    {
        try {
            $empresa->delete();


            return response()->json([
                'message' => 'Empresa eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error al eliminar el empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
