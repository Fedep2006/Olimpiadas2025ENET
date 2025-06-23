<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospedaje;
use App\Models\PaqueteContenido;
use App\Models\Vehiculo;
use App\Models\Viaje;
use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    private $contentTypes = [
        'viaje' => Viaje::class,
        'hospedaje' => Hospedaje::class,
        'vehiculo' => Vehiculo::class,
    ];

    public function getContenidoPorTipo(Request $request)
    {
        $tipo = $request->get('tipo');

        if (!isset($this->contentTypes[$tipo])) {
            return response()->json(['error' => 'Tipo de contenido no válido'], 400);
        }

        $modelClass = $this->contentTypes[$tipo];

        try {
            $contenido = $modelClass::select($this->getSelectFields($tipo))
                ->where('activo', true) // Si tienes campo activo
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $contenido,
                'tipo' => $tipo
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al cargar contenido'], 500);
        }
    }

    /**
     * Guardar relación polimórfica
     */
    public function guardarContenido(Request $request)
    {
        $request->validate([
            'contenido_type' => 'required|string|in:viaje,hospedaje,vehiculo',
            'contenido_id' => 'required|integer|min:1',
            // Otros campos que necesites...
        ]);

        $tipo = $request->contenido_type;
        $id = $request->contenido_id;
        $paquete_id = $request->paquete_id;

        // Verificar que el contenido existe
        $modelClass = $this->contentTypes[$tipo];
        $contenido = $modelClass::find($id);

        if (!$contenido) {
            return response()->json(['error' => 'El contenido seleccionado no existe'], 404);
        }

        try {
            $contenido = PaqueteContenido::create([
                'contenido_type' => $this->contentTypes[$tipo],
                'contenido_id' => $id,
                'paquete_id' => $paquete_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Contenido guardado exitosamente',
                'data' => [
                    'id' => $contenido->id,
                    'contenido_type' => $tipo,
                    'contenido_id' => $id,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al guardar'], 500);
        }
    }

    /**
     * Obtener campos a seleccionar según tipo
     */
    private function getSelectFields($tipo)
    {
        $fields = [
            'viaje' => ['id', 'numero_viaje'],
            'hospedaje' => ['id', 'nombre'],
            'vehiculo' => ['id', 'patente'],
        ];

        return $fields[$tipo] ?? ['id', 'created_at'];
    }
}
