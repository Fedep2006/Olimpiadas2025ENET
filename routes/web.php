<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\administracionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\HospedajeController;
use App\Http\Controllers\Admin\ViajeController;
use App\Http\Controllers\ResultsController;

use App\Models\Viaje;
use App\Models\Hospedaje;
use App\Models\Vehiculo;
use App\Models\Paquete;

// Rutas públicas
Route::get('/', function (Request $request) {
    $viajes     = Viaje::all();
    $hospedajes = Hospedaje::all();
    $vehiculos  = Vehiculo::all();
    return view('index', compact('viajes', 'hospedajes', 'vehiculos'));
});

// Ruta de resultados: texto y filtros avanzados unificados
Route::get('/results', [ResultsController::class, 'index'])
     ->name('results.index');

// Detalles de un ítem
Route::get('/details/{type}/{id}', function ($type, $id) {
    switch ($type) {
        case 'viaje':     $item = Viaje::findOrFail($id); break;
        case 'hospedaje': $item = Hospedaje::findOrFail($id); break;
        case 'vehiculo':  $item = Vehiculo::findOrFail($id); break;
        case 'paquete':   $item = Paquete::findOrFail($id); break;
        default: abort(404);
    }
    return view('details', compact('type','item'));
});

// Auth
Route::get('/login', function () {
    return view('login.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
     ->name('login.process');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

Route::resource('register', App\Http\Controllers\RegisterController::class)
     ->only(['index','store']);

// Rutas de usuario protegidas
Route::prefix('usuarios')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/create', [UserController::class, 'crear'])->name('usuarios.create');
    Route::put('/{user}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});

// Administración (requiere auth)
Route::prefix('administracion')->middleware('auth')->group(function () {
    Route::get('/', [administracionController::class, 'inicio'])->name('administracion.inicio');
    Route::get('/reportes', [administracionController::class, 'reportes'])->name('administracion.reportes');
    Route::get('/vehiculos', [administracionController::class, 'vehiculos'])->name('administracion.vehiculos');

    // Hospedajes
    Route::get('/hospedajes', [HospedajeController::class, 'index'])->name('administracion.hospedaje');
    Route::post('/hospedaje/store', [HospedajeController::class, 'HospedajeAgregar'])->name('administracion.hospedaje.Agregar');
    Route::post('/hospedaje/edit', [HospedajeController::class, 'HospedajeEditar'])->name('administracion.hospedaje.Editar');
    Route::delete('/hospedaje/delete/{id}', [HospedajeController::class, 'EliminarHospedaje'])->name('administracion.hospedaje.Borrar');

    // Paquetes y Viajes Admin
    Route::get('/paquetes', [administracionController::class, 'paquetes'])->name('administracion.paquetes');
    Route::get('/viajes', [ViajeController::class, 'index'])->name('administracion.viajes');
    Route::post('/viajes', [ViajeController::class, 'store'])->name('viajes.store');
    Route::get('/viajes/{id}/edit', [ViajeController::class, 'edit'])->name('viajes.edit');
    Route::put('/viajes/{id}', [ViajeController::class, 'update'])->name('viajes.update');
    Route::delete('/viajes/{id}', [ViajeController::class, 'destroy'])->name('viajes.destroy');

    // Empleados
    Route::get('/empleados', [administracionController::class, 'empleados'])->name('administracion.empleados');
});

// Rutas de prueba
Route::get('/test-compra', [App\Http\Controllers\TestCompraController::class, 'simularCompra']);
Route::get('/test-gmail', [App\Http\Controllers\TestGmailController::class, 'testGmail']);
Route::get('/test-email', [App\Http\Controllers\TestEmailController::class, 'testEmail']);
