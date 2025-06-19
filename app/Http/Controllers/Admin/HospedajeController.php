<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospedaje;
use App\Models\empresas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HospedajeController extends Controller
{
    public function index()
    {
            $hospedajes = Hospedaje::all();
            
            return view('administracion.hospedaje', compact('hospedajes'));

    }

    public function HospedajeAgregar(Request $request)
    {
        $hospedaje = new Hospedaje();

        $hospedaje->save();
        return redirect()->route('administracion.hospedaje')->with('success', 'Hospedaje agregado correctamente');
    }
    public function HospedajeEditar(Request $request)
    {
        $hospedaje = Hospedaje::find($request->id);
        
        if (!$hospedaje) {
            return redirect()->route('administracion.hospedaje')->with('error', 'El hospedaje no existe');
        }

        $hospedaje->nombre = $request->nombre;
        $hospedaje->tipo = $request->tipo;
        $hospedaje->ubicacion = $request->ubicacion;
        $hospedaje->pais = $request->pais;
        $hospedaje->ciudad = $request->ciudad;
        $hospedaje->codigo_postal = $request->codigo_postal;
        $hospedaje->estrellas = $request->estrellas;
        $hospedaje->calificacion = $request->calificacion;
        $hospedaje->descripcion = $request->descripcion;
        $hospedaje->servicios = $request->servicios;
        $hospedaje->politicas = $request->politicas;
        $hospedaje->imagenes = $request->imagenes;
        $hospedaje->telefono = $request->telefono;
        $hospedaje->email = $request->email;
        $hospedaje->sitio_web = $request->sitio_web;
        $hospedaje->check_in = $request->check_in;
        $hospedaje->check_out = $request->check_out;
        if ($request->check_in_24h == 1) {
            $hospedaje->check_in_24h = 1;
        } else {
            $hospedaje->check_in_24h = 0;
        }
        $hospedaje->disponibilidad = $request->disponibilidad;
        $hospedaje->observaciones = $request->observaciones;
        $hospedaje->save();
        return redirect()->route('administracion.hospedaje')->with('success', 'Hospedaje actualizado correctamente');
    }
    public function EliminarHospedaje($id)
    {
        $hospedaje = Hospedaje::find($id);
        $hospedaje->delete();
        return redirect()->route('administracion.hospedaje')->with('success', 'Hospedaje eliminado correctamente');
    }

    public function verHabitaciones($id)
    {
        try {
            $hospedaje = Hospedaje::with('habitaciones')->findOrFail($id);
            return view('administracion.habitaciones', compact('hospedaje'));
        } catch (\Exception $e) {
            Log::error('Error al cargar las habitaciones: ' . $e->getMessage());
            return redirect()->route('administracion.hospedaje')->with('error', 'Error al cargar las habitaciones');
        }
    }
}