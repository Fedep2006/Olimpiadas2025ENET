<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospedaje;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HospedajeController extends Controller
{
    public function index()
    {
        try {
            $hospedajes = Hospedaje::all();
            return view('administracion.hospedaje', compact('hospedajes'));
        } catch (\Exception $e) {
            Log::error('Error al cargar la vista de hospedajes: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar los hospedajes');
        }
    }

    public function HospedajeAgregar(Request $request)
    {
        $hospedaje = new Hospedaje();
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
        $hospedaje->disponibilidad = $request->disponibilidad;
        $hospedaje->observaciones = $request->observaciones;
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
        $hospedaje->disponibilidad = $request->disponibilidad;
        $hospedaje->observaciones = $request->observaciones;
        $hospedaje->save();
        return redirect()->route('administracion.hospedaje')->with('success', 'Hospedaje actualizado correctamente');
    }
    public function destroyHospedaje($id)
    {
        $hospedaje = Hospedaje::find($id);
        $hospedaje->delete();
        return redirect()->route('administracion.hospedaje')->with('success', 'Hospedaje eliminado correctamente');
    }
}