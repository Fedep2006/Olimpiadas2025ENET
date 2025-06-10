<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\administracionController;

Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('login.login');
});
Route::get('/register', function () {
    return view('login.register'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/detalles', function () {
    return view('detalles'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/carrito', function () {
    return view('login.carrito'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/busqueda', function () {
    return view('busqueda'); // Make sure resources/views/login/register.blade.php exists
});

Route::prefix('administracion')->group(function () {

    Route::get('/', [administracionController::class, 'inicio'])->name('administracion.inicio');

    Route::get('/reportes', [administracionController::class, 'reportes'])->name('administracion.reportes');

    Route::get('/vehiculos', [administracionController::class, 'vehiculos'])->name('administracion.vehiculos');

    Route::get('/hoteles', [administracionController::class, 'hoteles'])->name('administracion.hoteles');

    Route::get('/paquetes', [administracionController::class, 'paquetes'])->name('administracion.paquetes');

    Route::get('/reservas', [administracionController::class, 'reservas'])->name('administracion.reservas');

    Route::get('/usuarios', [administracionController::class, 'usuarios'])->name('administracion.usuarios');

    Route::get('/viajes', [administracionController::class, 'vuelos'])->name('administracion.viajes');
});
