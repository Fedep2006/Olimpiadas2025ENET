<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\administracionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('login.login');
});

route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])
    ->name('register');

Route::post('/CrearRegistro', [App\Http\Controllers\RegisterController::class, 'register'])
    ->name('register.process');

Route::get('/detalles', function () {
    return view('detalles'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/carrito', function () {
    return view('login.carrito'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/busqueda', function () {
    return view('busqueda'); // Make sure resources/views/login/register.blade.php exists
});

Route::prefix('administracion')->middleware('auth')->group(function () {

    Route::get('/', [AdministracionController::class, 'inicio'])->name('administracion.inicio');

    Route::get('/reportes', [AdministracionController::class, 'reportes'])->name('administracion.reportes');

    Route::get('/vehiculos', [AdministracionController::class, 'vehiculos'])->name('administracion.vehiculos');

    Route::get('/hoteles', [AdministracionController::class, 'hoteles'])->name('administracion.hoteles');
    Route::post('/hoteles/actualizar', [AdministracionController::class, 'EditHoteles'])->name('administracion.hoteles.update');

    Route::get('/paquetes', [AdministracionController::class, 'paquetes'])->name('administracion.paquetes');

    Route::get('/reservas', [AdministracionController::class, 'reservas'])->name('administracion.reservas');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios/create', [UserController::class, 'crear'])->name('usuarios.create');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/viajes', [administracionController::class, 'vuelos'])->name('administracion.viajes');

    Route::get('/empleados', [administracionController::class, 'empleados'])->name('administracion.empleados');
});

// Rutas para el ABM de hoteles
Route::prefix('administracion')->group(function () {
    Route::get('/hoteles', [App\Http\Controllers\Admin\HotelController::class, 'index'])->name('administracion.hoteles');
    Route::post('/hoteles', [App\Http\Controllers\Admin\HotelController::class, 'store'])->name('hoteles.store');
    Route::get('/hoteles/{id}', [App\Http\Controllers\Admin\HotelController::class, 'show'])->name('hoteles.show');
    Route::put('/hoteles/{id}', [App\Http\Controllers\Admin\HotelController::class, 'update'])->name('hoteles.update');
    Route::delete('/hoteles/{id}', [App\Http\Controllers\Admin\HotelController::class, 'destroy'])->name('hoteles.destroy');
});

// Mostrar el formulario
Route::get('/login', function () {
    return view('login.login');
})->name('login');

// Procesar el login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

//logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

Route::prefix('usuarios')->middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/create', [UserController::class, 'crear'])->name('usuarios.create');
    Route::put('/{user}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});
