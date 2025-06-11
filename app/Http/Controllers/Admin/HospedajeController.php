<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospedaje;

class HospedajeController extends Controller
{
    public function index(){
        $hospedajes = Hospedaje::all();
        return view('administracion.hospedaje', compact('hospedajes'));
    }

    public function EditHospedaje(Request $request){
        $request->validate([
            'id' => 'required|exists:hospedajes,id',
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);
        
        $hospedaje = Hospedaje::findOrFail($request->id);
        $hospedaje->update([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion
        ]);

        return response()->json(['success' => true, 'message' => 'Hospedaje actualizado correctamente']);
    }

    public function storeHospedaje(Request $request){
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);

        Hospedaje::create([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion
        ]);

        return response()->json(['success' => true, 'message' => 'Hospedaje creado correctamente']);
    }

    public function destroyHospedaje($id){
        $hospedaje = Hospedaje::findOrFail($id);
        $hospedaje->delete();
        return response()->json(['success' => true, 'message' => 'Hospedaje eliminado correctamente']);
    }
}
