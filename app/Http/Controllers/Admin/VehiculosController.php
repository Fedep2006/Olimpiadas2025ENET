<?php

namespace App\Http\Controllers\Admin;
use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class VehiculosController extends Controller
{
    // Muestra el detalle de un vehículo
    public function show($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('detalles', compact('vehiculo'));
    }
    public function index(){
        $vehiculo = Vehiculo::all();
        return view("administracion.vehiculos" ,compact("vehiculo"));

    }

    public function AñadirVehiculo(Request $request){

        $Vehiculo = new Vehiculo();
        $Vehiculo->id = $request->id;
        $Vehiculo->tipo = $request->tipo;
        $Vehiculo->marca = $request->marca;
        $Vehiculo->modelo = $request->modelo;
        $Vehiculo->antiguedad = $request->antiguedad;
        $Vehiculo->patente = $request->patente;
        $Vehiculo->color = $request->color;
        $Vehiculo->capacidad_pasajeros = $request->capacidad_pasajeros;
        $Vehiculo->ubicacion = $request->ubicacion;
        $Vehiculo->precio_por_dia = $request->precio_por_dia;
        $Vehiculo->disponible = $request->disponible;
        $Vehiculo->imagenes = $request->imagenes;
        $Vehiculo->caracteristicas = $request->caracteristicas;
        $Vehiculo->observaciones = $request->observaciones;
        $Vehiculo->save();
        return redirect()->route("administracion.vehiculos")->with("success", "Vehiculo agregado correctamente");
    }

    public function EditarVehiculo(Request $request){

       $vehiculo = Vehiculo::find($request->id);
       $vehiculo->tipo = $request->tipo;
       $vehiculo->marca = $request->marca;
       $vehiculo->modelo = $request->modelo;
       $vehiculo->antiguedad = $request->antiguedad;
       $vehiculo->patente = $request->patente;
       $vehiculo->color = $request->color;
       $vehiculo->capacidad_pasajeros = $request->capacidad_pasajeros;
       $vehiculo->ubicacion = $request->ubicacion;
       $vehiculo->precio_por_dia = $request->precio_por_dia;
       $vehiculo->disponible = $request->disponible;
       $vehiculo->imagenes = $request->imagenes;
       $vehiculo->caracteristicas = $request->caracteristicas;
       $vehiculo->observaciones = $request->observaciones;
       $vehiculo->save();
       return redirect()->route("administracion.vehiculos")->with("success", "Vehiculo actualizado correctamente");
    }

    public function EliminarVehiculo($id){

        $vehiculo = Vehiculo::find($id);
        if (!$vehiculo) {
            return redirect()->route("administracion.vehiculos")->with("error", "Vehiculo no encontrado");
        }
        $vehiculo->delete();
        return redirect()->route("administracion.vehiculos")->with("success", "Vehiculo eliminado correctamente");
    }

}