<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\administracionController;
use App\Http\Controllers\AuthController;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

function createUserIfNotExists()
{
    if (!User::where('email', 'a@gmail.com')->exists()) {
        $user = User::create([
            'name' => 'aaron',
            'email' => 'a@gmail.com',
            'password' => bcrypt('123'), // Always hash the password!
        ]);
    }
}

Route::get('/', function () {
    createUserIfNotExists();
    return view('index');
});
Route::get('/login', function () {
    return view('login.login');
});

route::get( '/register' , [App\Http\Controllers\RegisterController::class, 'index'])
    ->name('register');

    Route::post( '/CrearRegistro' , [App\Http\Controllers\RegisterController::class, 'register'])
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

    Route::get('/', [administracionController::class, 'inicio'])->name('administracion.inicio');

    Route::get('/reportes', [administracionController::class, 'reportes'])->name('administracion.reportes');

    Route::get('/vehiculos', [administracionController::class, 'vehiculos'])->name('administracion.vehiculos');

    Route::get('/hoteles', [administracionController::class, 'hoteles'])->name('administracion.hoteles');

    Route::get('/paquetes', [administracionController::class, 'paquetes'])->name('administracion.paquetes');

    Route::get('/reservas', [administracionController::class, 'reservas'])->name('administracion.reservas');

    Route::get('/usuarios', [administracionController::class, 'usuarios'])->name('administracion.usuarios');

    Route::get('/viajes', [administracionController::class, 'vuelos'])->name('administracion.viajes');
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
