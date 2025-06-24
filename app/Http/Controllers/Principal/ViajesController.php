<?php

namespace App\Http\Controllers\Principal;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use App\Http\Requests\ViajeRequest;

class ViajesController extends Controller
{
    /**
     * Muestra el detalle de un viaje
     */
    public function show($id)
    {
        $item = \App\Models\Viaje::findOrFail($id);
        $tipo = 'viaje';
        return view('details', compact('item', 'tipo'));
    }
}
