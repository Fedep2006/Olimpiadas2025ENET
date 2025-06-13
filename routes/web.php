<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\administracionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\HospedajeController;
use App\Models\User;
use App\Models\Viaje;
use App\Models\Hospedaje;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Route::get('/', function (Request $request) {
    $viajes     = Viaje::all();
    $hospedajes = Hospedaje::all();
    $vehiculos  = Vehiculo::all();
    return view('index', compact('viajes', 'hospedajes', 'vehiculos'));
});
Route::get('/results', function (Request $request) {
    $term     = $request->query('search');
    $filters  = $request->query('filters', []);
    if (empty($filters)) {
        $filters = ['viaje','hospedaje','vehiculo','paquete'];
    }

    $results = [];

    if (in_array('viaje', $filters)) {
        $results['viajes'] = Viaje::when($term, fn($q) =>
            $q->where('nombre', 'like', "%{$term}%")
        )->get();
    }
    if (in_array('hospedaje', $filters)) {
        $results['hospedajes'] = Hospedaje::when($term, fn($q) =>
            $q->where('nombre', 'like', "%{$term}%")
        )->get();
    }
    if (in_array('vehiculo', $filters)) {
        $results['vehiculos'] = Vehiculo::when($term, fn($q) =>
            $q->where('marca', 'like', "%{$term}%")
              ->orWhere('modelo', 'like', "%{$term}%")
        )->get();
    }
    if (in_array('paquete', $filters)) {
        $results['paquetes'] = collect()
            ->merge($results['viajes'] ?? [])
            ->merge($results['hospedajes'] ?? [])
            ->merge($results['vehiculos'] ?? []);
    }

    return view('results', [
      'results' => $results,
      'term'    => $term,
      'filters' => $filters,
    ]);
});

Route::get('/details/{type}/{id}', function($type, $id) {
    switch($type) {
        case 'viaje':     $item = Viaje::findOrFail($id); break;
        case 'hospedaje': $item = Hospedaje::findOrFail($id); break;
        case 'vehiculo':  $item = Vehiculo::findOrFail($id); break;
        // case 'paquete':  // si tienes modelo propio
        default: abort(404);
    }
    return view('details', compact('type','item'));
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

    Route::get('/hospedajes', [HospedajeController::class, 'index'])->name('administracion.hospedaje');
    Route::post('/hospedaje/store', [HospedajeController::class, 'HospedajeAgregar'])->name('administracion.hospedaje.Agregar');
    Route::post('/hospedaje/edit', [HospedajeController::class, 'HospedajeEditar'])->name('administracion.hospedaje.Editar');
    Route::delete('/hospedaje/delete/{id}', [HospedajeController::class, 'EliminarHospedaje'])->name('administracion.hospedaje.Borrar');
    Route::get('/paquetes', [AdministracionController::class, 'paquetes'])->name('administracion.paquetes');

    Route::get('/reservas', [AdministracionController::class, 'reservas'])->name('administracion.reservas');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios/create', [UserController::class, 'crear'])->name('usuarios.create');
    Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/viajes', [App\Http\Controllers\Admin\ViajeController::class, 'index'])->name('administracion.viajes');
    Route::post('/viajes', [App\Http\Controllers\Admin\ViajeController::class, 'store'])->name('viajes.store');
    Route::get('/viajes/{id}/edit', [App\Http\Controllers\Admin\ViajeController::class, 'edit'])->name('viajes.edit');
    Route::put('/viajes/{id}', [App\Http\Controllers\Admin\ViajeController::class, 'update'])->name('viajes.update');
    Route::delete('/viajes/{id}', [App\Http\Controllers\Admin\ViajeController::class, 'destroy'])->name('viajes.destroy');

    Route::get('/empleados', [administracionController::class, 'empleados'])->name('administracion.empleados');
});

// Rutas para el ABM de hoteles
/*
Route::prefix('administracion')->group(function () {
    Route::get('/hoteles', [App\Http\Controllers\Admin\HotelController::class, 'index'])->name('administracion.hoteles');
    Route::post('/hoteles', [App\Http\Controllers\Admin\HotelController::class, 'store'])->name('hoteles.store');
    Route::get('/hoteles/{id}', [App\Http\Controllers\Admin\HotelController::class, 'show'])->name('hoteles.show');
    Route::put('/hoteles/{id}', [App\Http\Controllers\Admin\HotelController::class, 'update'])->name('hoteles.update');
    Route::delete('/hoteles/{id}', [App\Http\Controllers\Admin\HotelController::class, 'destroy'])->name('hoteles.destroy');
});
*/
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

// Ruta de prueba para simular una compra
Route::get('/test-compra', [App\Http\Controllers\TestCompraController::class, 'simularCompra']);

// Ruta de prueba para Gmail
Route::get('/test-gmail', [App\Http\Controllers\TestGmailController::class, 'testGmail']);

// Ruta de prueba para probar el envío de correos
Route::get('/test-email', [App\Http\Controllers\TestEmailController::class, 'testEmail']);