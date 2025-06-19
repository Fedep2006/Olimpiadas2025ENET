<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use App\Http\Requests\ViajeRequest;

class ViajeController extends Controller
{
    /**
     * Muestra el detalle de un viaje
     */
    public function show($id)
    {
        $viaje = \App\Models\Viaje::findOrFail($id);
        return view('administracion.viajes-show', compact('viaje'));
    }
}
