<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa; 

class EmpresasController extends Controller
{
    public function index(){
        $empresas = Empresa::all();
        return view("administracion.empresas" ,compact("empresas"));
    }

    public function crear(Request $request){
        $empresas = new Empresa();
        $empresas->nombre = $request->nombreEmpresa;
        $empresas->tipo = $request->tipoEmpresa;
        $empresas->save();
        return redirect()->route('administracion.empresas')->with('success', 'Empresa creada exitosamente.');
        
    }

    public function editar(Request $request){
        $empresas = Empresa::find($request->id);
        $empresas->nombre = $request->nombreEmpresa;
        $empresas->tipo = $request->tipoEmpresa;
        $empresas->save();
        return redirect()->route('administracion.empresas')->with('success', 'Empresa actualizada exitosamente.');

    }

    public function borrar(Request $request){

        $empresas = Empresa::find($request->id);
        $empresas->delete();
        return redirect()->route('administracion.empresas')->with('success', 'Empresa eliminada exitosamente.');
        
    }
}
