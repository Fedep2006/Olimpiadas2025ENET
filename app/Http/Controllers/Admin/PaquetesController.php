<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paquete;
use App\Models\PaqueteContenido;
use Illuminate\Support\Facades\DB;

class PaquetesController extends Controller
{
    public function index(){
        $paquetes = Paquete::all();
        return view("administracion.paquetes",compact("paquetes"));
    }

    public function Añadir(Request $request){
        $paquetes = new Paquete();
        $paquetes->nombre = $request->nombre;
        $paquetes->descripcion = $request->descripcion;
        $paquetes->precio_total = $request->precio_total;
        $paquetes->duracion = $request->duracion;
        $paquetes->ubicacion = $request->ubicacion;
        $paquetes->cupo_minimo = $request->cupo_minimo;
        $paquetes->cupo_maximo = $request->cupo_maximo;
        $paquetes->activo = $request->activo;
        $paquetes->condiciones = $request->condiciones;
        $paquetes->imagenes = $request->imagenes;
        $paquetes->save();
        
        return redirect()->route("administracion.paquetes");
    }

    public function Borrar($id){
        $paquete = Paquete::find($id);
        $paquete->delete();
         return redirect()->route("administracion.paquetes");
    }

    public function Editar(Request $request){
        $paquete = Paquete::find($request->id);
        if (!$paquete) {
            return redirect()->route("administracion.paquetes")->withErrors(['Paquete no encontrado.']);
        }
        $paquete->nombre = $request->nombre;
        $paquete->descripcion = $request->descripcion;
        $paquete->precio_total = $request->precio_total;
        $paquete->duracion = $request->duracion;
        $paquete->ubicacion = $request->ubicacion;
        $paquete->cupo_minimo = $request->cupo_minimo;
        $paquete->cupo_maximo = $request->cupo_maximo;
        $paquete->activo = $request->activo;
        $paquete->condiciones = $request->condiciones;
        $paquete->imagenes = $request->imagenes;
        $paquete->save();

        return redirect()->route("administracion.paquetes");    
    }
}
