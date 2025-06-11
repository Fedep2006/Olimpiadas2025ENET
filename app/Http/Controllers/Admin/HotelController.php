<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hoteles = Hotel::all();
        return view('administracion.hoteles', compact('hoteles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'estrellas' => 'required|integer|min:1|max:5',
            'habitaciones' => 'required|integer|min:1',
            'tipos_habitacion' => 'required|string|max:255',
            'precio_por_noche' => 'required|numeric|min:0',
            'disponibilidad' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $hotel = Hotel::create($request->all());
            return response()->json([
                'message' => 'Hotel creado exitosamente',
                'hotel' => $hotel
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el hotel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'estrellas' => 'required|integer|min:1|max:5',
            'habitaciones' => 'required|integer|min:1',
            'tipos_habitacion' => 'required|string|max:255',
            'precio_por_noche' => 'required|numeric|min:0',
            'disponibilidad' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $hotel = Hotel::findOrFail($id);
            $hotel->update($request->all());
            return response()->json([
                'message' => 'Hotel actualizado exitosamente',
                'hotel' => $hotel
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el hotel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            $hotel->delete();
            return response()->json([
                'message' => 'Hotel eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el hotel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            return response()->json($hotel);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el hotel',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 