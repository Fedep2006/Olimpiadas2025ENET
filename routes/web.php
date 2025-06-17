<?php

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
    $viajes     = Viaje::all();
    $hospedajes = Hospedaje::all();
    $vehiculos  = Vehiculo::all();
    return view('index', compact('viajes', 'hospedajes', 'vehiculos'));
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

    // Reservas
    Route::get('/reservas', [AdministracionController::class, 'reservas']);
    // Acciones de reservas de vehículos
    Route::post('/reservas/vehiculos/{reserva}/aceptar', [AdministracionController::class, 'aceptarReservaVehiculo'])->name('administracion.reservas.vehiculos.aceptar');
    Route::post('/reservas/vehiculos/{reserva}/rechazar', [AdministracionController::class, 'rechazarReservaVehiculo'])->name('administracion.reservas.vehiculos.rechazar');
    // Acciones de reservas de hospedaje (añadido sin afectar rutas existentes)
    Route::post('/reservas/hospedaje/{reserva}/aceptar', [AdministracionController::class, 'aceptarReservaHospedaje'])->name('administracion.reservas.hospedaje.aceptar');
    Route::post('/reservas/hospedaje/{reserva}/rechazar', [AdministracionController::class, 'rechazarReservaHospedaje'])->name('administracion.reservas.hospedaje.rechazar');
    // Acciones de reservas de hospedaje
    Route::post('/reservas/hospedaje/{reserva}/aceptar', [AdministracionController::class, 'aceptarReservaHospedaje'])->name('administracion.reservas.hospedaje.aceptar');
    Route::post('/reservas/hospedaje/{reserva}/rechazar', [AdministracionController::class, 'rechazarReservaHospedaje'])->name('administracion.reservas.hospedaje.rechazar');

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


    Route::get('/viajes',                 [AdminViajeController::class, 'index'])->name('administracion.viajes');
    Route::post('/viajes',                [AdminViajeController::class, 'store'])->name('viajes.store');
    // Detalle de viaje
    Route::get('/viajes/{viaje}', [\App\Http\Controllers\Admin\ViajeController::class, 'show'])->name('viajes.show');
    // Reservar viaje
    Route::post('/viajes/{viaje}/reservar', [\App\Http\Controllers\Admin\ViajeController::class, 'reservasViaje'])->name('reservas.viaje');
    Route::put('/viajes/{id}',            [AdminViajeController::class, 'update'])->name('viajes.update');
    Route::delete('/viajes/{id}',         [AdminViajeController::class, 'destroy'])->name('viajes.destroy');

    Route::get('/viajes',                 [ViajeController::class, 'index'])->name('administracion.index');
    Route::post('/viajes/create',       [ViajeController::class, 'crear'])->name('usuarios.create');
    Route::put('/viajes/{viaje}',        [ViajeController::class, 'update'])->name('usuarios.update');
    Route::delete('/viajes/{viaje}', [ViajeController::class, 'destroy'])->name('usuarios.destroy');


    // Usuarios
    Route::get('/usuarios',               [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios/create',       [UserController::class, 'crear'])->name('usuarios.create');
    Route::put('/usuarios/{user}',        [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    // Empleados
    Route::get('/empleados',              [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::post('/empleados/create',       [EmpleadoController::class, 'crear'])->name('empleados.create');
    Route::put('/empleados/{empleado}',        [EmpleadoController::class, 'update'])->name('empleados.update');
    Route::delete('/empleados/{empleado}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');

    // Rutas para habitaciones
    Route::get('/habitaciones/{hospedaje_id}', [App\Http\Controllers\Admin\HabitacionController::class, 'verHabitaciones'])->name('administracion.habitaciones');
    Route::post('/habitaciones/agregar', [App\Http\Controllers\Admin\HabitacionController::class, 'agregar'])->name('administracion.habitaciones.agregar');
    Route::put('/habitaciones/{id}/editar', [App\Http\Controllers\Admin\HabitacionController::class, 'editar'])->name('administracion.habitaciones.editar');
    Route::put('/habitaciones/{id}/cambiar-estado', [App\Http\Controllers\Admin\HabitacionController::class, 'cambiarEstado'])->name('administracion.habitaciones.cambiar-estado');
    Route::delete('/habitaciones/{id}', [App\Http\Controllers\Admin\HabitacionController::class, 'eliminar'])->name('administracion.habitaciones.eliminar');
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
