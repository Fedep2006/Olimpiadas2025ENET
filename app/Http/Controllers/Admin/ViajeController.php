<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ViajeController extends Controller
{
    public function index()
    {
        $viajes = Viaje::all();
        return view('administracion.viajes', compact('viajes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:aereo,terrestre,maritimo',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after:fecha_salida',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $data['imagen'] = file_get_contents($imagen->getRealPath());
            Log::info('Tamaño de la imagen: ' . strlen($data['imagen']));
        }

        Viaje::create($data);

        return response()->json(['success' => true]);
    }

    public function show(Viaje $viaje)
    {
        return response()->json($viaje);
    }

    public function update(Request $request, Viaje $viaje)
    {
        $request->validate([
            'tipo' => 'required|in:aereo,terrestre,maritimo',
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after:fecha_salida',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $data['imagen'] = file_get_contents($imagen->getRealPath());
            Log::info('Tamaño de la imagen actualizada: ' . strlen($data['imagen']));
        }

        $viaje->update($data);

        return response()->json(['success' => true]);
    }

    public function destroy(Viaje $viaje)
    {
        $viaje->delete();
        return response()->json(['success' => true]);
    }
} 