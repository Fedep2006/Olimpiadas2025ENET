<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Viaje;
use App\Models\Hospedaje;
use App\Models\Vehiculo;

class CiudadController extends Controller
{
    // Devuelve un array único de ciudades posibles para autocompletar (origen y destino)
    public function index(Request $request)
    {
        // Tomar ciudades de origen y destino de viajes, ciudades de hospedajes y ubicacion de vehiculos
        $origenes = Viaje::pluck('origen')->toArray();
        $destinos = Viaje::pluck('destino')->toArray();
        $hospedajes = Hospedaje::pluck('ciudad')->toArray();
        $vehiculos = Vehiculo::pluck('ubicacion')->toArray();
        $ciudades = array_unique(array_filter(array_merge($origenes, $destinos, $hospedajes, $vehiculos)));
        sort($ciudades);
        return response()->json(array_values($ciudades));
    }
}
