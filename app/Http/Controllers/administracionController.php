<?php

namespace App\Http\Controllers;

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
    public function autos()
    {
        return view('administracion.vehiculos');
    }
    public function hoteles()
    {
        return view('administracion.hoteles');
    }
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
}
