<?php

use App\Http\Controllers\Admin\EmpresasController;
use App\Http\Controllers\Admin\PaquetesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controladores
use App\Http\Controllers\PagoController;

Route::post('/vehiculos/{id}/pago-ficticio', [PagoController::class, 'storeFicticio'])->name('vehiculos.pago_ficticio');
Route::post('/vehiculos/{id}/reservar', [App\Http\Controllers\Admin\VehiculosController::class, 'reservar'])->name('vehiculos.reservar');

use App\Http\Controllers\administracionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\Admin\VehiculosController;
use App\Http\Controllers\Admin\HospedajeController;
use App\Http\Controllers\Admin\ViajeController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TestCompraController;
use App\Http\Controllers\TestGmailController;
use App\Http\Controllers\TestEmailController;

// Modelos
use App\Models\User;
use App\Models\Viaje;
use App\Models\Hospedaje;
use App\Models\Vehiculo;
use App\Models\Paquete;

// Ruta de búsqueda unificada de texto y filtros avanzados
Route::get('/results', [ResultsController::class, 'index'])
    ->name('results.index');

// Página de inicio
Route::get('/', function (Request $request) {
    $paquetes = Paquete::all();
    return view('index', compact('paquetes'));
});

// Detalles de un vehículo
Route::get('/vehiculos/{id}', [VehiculosController::class, 'show'])->name('vehiculos.show');

// Detalles de un recurso
Route::get('/details/{type}/{id}', function ($type, $id) {
    switch ($type) {
        case 'viaje':
            $item = Viaje::findOrFail($id);
            break;
        case 'hospedaje':
            $item = Hospedaje::findOrFail($id);
            break;
        case 'vehiculo':
            $item = Vehiculo::findOrFail($id);
            break;
        case 'paquete':
            $item = Paquete::findOrFail($id);
            break;
        default:
            abort(404);
    }
    return view('details', compact('type', 'item'));
});

// Autenticación
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

// Registro de usuarios
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/CrearRegistro', [RegisterController::class, 'register'])->name('register.process');

// Verificación de email
Route::get('/verify-email', [\App\Http\Controllers\RegisterController::class, 'verifyEmail'])->name('verify.email');

// Vistas estáticas
Route::get('/detalles', function () {
    return view('detalles');
});
Route::get('/carrito',  function () {
    return view('login.carrito');
});
Route::get('/busqueda', function () {
    return view('busqueda');
});

// Área de administración (requiere auth)
Route::prefix('administracion')->middleware('auth')->group(function () {
    Route::get('/',        [administracionController::class, 'inicio'])->name('administracion.inicio');
    Route::get('/reportes', [administracionController::class, 'reportes'])->name('administracion.reportes');


    // Reservar
    Route::get('/reservas', [AdministracionController::class, 'reservas']);

    //empresas
    Route::get('/empresas', [EmpresasController::class, 'index'])->name('administracion.empresas');
    Route::post('/empresas/añadir', [EmpresasController::class, 'crear'])->name('administracion.empresas.añadir');
    Route::post('/empresas/editar', [EmpresasController::class, 'editar'])->name('administracion.empresas.editar');
    Route::delete('/empresas/borrar/{id}', [EmpresasController::class, 'borrar'])->name('administracion.empresas.borrar');

    // Vehículos
    Route::get('/vehiculos',                [VehiculosController::class, 'index'])->name('administracion.vehiculos');
    Route::post('/vehiculos/añadir',        [VehiculosController::class, 'AñadirVehiculo'])->name('administracion.vehiculos.añadir');
    Route::post('/vehiculos/editar',        [VehiculosController::class, 'EditarVehiculo'])->name('administracion.vehiculos.editar');
    Route::delete('/vehiculos/borrar/{id}', [VehiculosController::class, 'EliminarVehiculo'])->name('administracion.vehiculos.borrar');

    // Hospedajes
    Route::get('/hospedajes',               [HospedajeController::class, 'index'])->name('administracion.hospedaje');
    Route::post('/hospedaje/store',         [HospedajeController::class, 'HospedajeAgregar'])->name('administracion.hospedaje.Agregar');
    Route::post('/hospedaje/edit',          [HospedajeController::class, 'HospedajeEditar'])->name('administracion.hospedaje.Editar');
    Route::delete('/hospedaje/delete/{id}', [HospedajeController::class, 'EliminarHospedaje'])->name('administracion.hospedaje.Borrar');
    Route::get('/hospedaje/{id}/habitaciones', [HospedajeController::class, 'verHabitaciones'])->name('administracion.hospedaje.habitaciones');

    // Paquetes y Viajes Admin
    Route::get('/paquetes',               [PaquetesController::class, 'index'])->name('administracion.paquetes');
    Route::post('/paquetes/añadir',              [PaquetesController::class, 'Añadir'])->name('administracion.paquetes.añadir');
    Route::post('/paquetes/editar',     [PaquetesController::class, 'Editar'])->name('administracion.paquetes.editar');
    Route::delete('/paquetes/borrar/{id}',       [PaquetesController::class, 'Borrar'])->name('administracion.paquetes.borrar');


    // Detalle de viaje

    Route::get('/viajes',                 [ViajeController::class, 'index'])->name('administracion.index');
    Route::post('/viajes/create',       [ViajeController::class, 'crear'])->name('usuarios.create');
    Route::put('/viajes/{viaje}',        [ViajeController::class, 'update'])->name('usuarios.update');
    Route::delete('/viajes/{viaje}', [ViajeController::class, 'destroy'])->name('usuarios.destroy');


    // Usuarios
    Route::get('/usuarios',               [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios/create',       [UserController::class, 'crear'])->name('usuarios.create');
    Route::put('/usuarios/{user}',        [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});

Route::get('/terminos', function () {
    return view('login.terminos');
})->name('terminos');

Route::get('/back', function () {
    return view('login.register');
})->name('back');

// API autocomplete ciudades
Route::get('/api/ciudades', [\App\Http\Controllers\Api\CiudadController::class, 'index']);

// Rutas de prueba
Route::get('/test-compra', [TestCompraController::class, 'simularCompra']);
Route::get('/test-gmail',  [TestGmailController::class, 'testGmail']);
Route::get('/test-email',  [TestEmailController::class, 'testEmail']);
