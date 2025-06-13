<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paquete;
use Illuminate\Support\Facades\DB;

class PaquetesController extends Controller
{
    public function index(){
        $paquetes = Paquete::all();
        return view("administracion.paquetes",compact("paquetes"));
    }
}
