<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaqueteRequest;
use App\Models\Paquete;

class PaquetesController extends Controller
{
    /**
     * Muestra el detalle de un paquete para el público.
     * Solo se permite acceder a paquetes activos creados por la empresa (hecho_por_usuario = 0).
     */
    public function show($id)
    {
        $item = Paquete::where('id', $id)
            ->where('hecho_por_usuario', '!=', 1)
            ->where('activo', 1)
            ->firstOrFail();

        $tipo = 'paquete';

        return view('details', compact('item', 'tipo'));
    }
}
