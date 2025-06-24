<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Muestra la página de ayuda.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('ayuda');
    }
}
