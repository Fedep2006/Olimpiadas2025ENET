<?php

namespace App\Http\Controllers;

use App\Models\Hospedaje;
use Illuminate\Http\Request;


class administracionController extends Controller
{
    public function inicio()
    {
        return view('administracion.inicio');
    }
    public function reservas()
    {
        return view('administracion.reservas');
    }
    public function vehiculos()
    {
        return view('administracion.vehiculos');
    }

    //Seccion Hospedaje
    public function hoteles()
    {

    $hoteles = Hospedaje::all(); // Puedes agregar paginación o filtros si lo deseas
    return view('administracion.hoteles', compact('hoteles'));


    }

    public function EditHoteles(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:hospedajes,id', // Asegúrate de que el ID del hospedaje exista
            'nombre' => 'required|string|max:255', 
            'ubicacion' => 'required|string|max:255', 
            'descripcion' => 'required|string|max:255', 
            'habitaciones' =>  'required|integer|min:1', 
            'precio_por_noche' =>  'required|numeric|min:0',
            'disponibilidad' =>  'required',
        ]);

        $hospedaje = Hospedaje::findOrFail($request->id);
        $disponibilidad = filter_var($request->disponibilidad, FILTER_VALIDATE_BOOLEAN);
        $hospedaje->update([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'habitaciones' => $request->habitaciones,
            'precio_por_noche' => $request->precio_por_noche,
            'disponibilidad' => $disponibilidad,
        ]);

        return redirect()->route('administracion.hoteles')->with('success', 'Hotel updated successfully.');
    }
    

        

    
    //Seccion Paquetes
    public function paquetes()
    {
        return view('administracion.paquetes');
    }
    public function reportes()
    {
        return view('administracion.reportes');
    }
    public function usuarios()
    {
        return view('administracion.usuarios');
    }
    public function vuelos()
    {
        return view('administracion.viajes');
    }
     public function empleados()
    {
        return view('administracion.empleados');
    }
}
