<?php

namespace App\Http\Requests\Traits;

use Illuminate\Support\Facades\Auth;

trait AutorizarEmpleado
{
    public function autorizarEmpleado(): bool
    {
        return Auth::check() && Auth::user()->nivel > 0;
    }
}
