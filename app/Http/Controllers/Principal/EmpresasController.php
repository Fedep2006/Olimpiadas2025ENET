<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresasController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view("administracion.empresas", compact("empresas"));
    }
}
