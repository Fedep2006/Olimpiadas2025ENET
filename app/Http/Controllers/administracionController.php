<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdministracionController extends Controller
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
    public function hospedaje()
    {

        return view('administracion.hospedaje');
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
