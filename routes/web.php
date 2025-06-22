<?php

use App\Http\Controllers\Admin\AdminUsuariosController;
use App\Http\Controllers\Admin\AdminEmpresasController;
use App\Http\Controllers\Admin\AdminHospedajesController;
use App\Http\Controllers\Admin\AdminPaquetesController;
use App\Http\Controllers\Admin\AdminReservasController;
use App\Http\Controllers\Admin\AdminVehiculosController;
use App\Http\Controllers\Admin\AdminViajesController;

use App\Http\Controllers\Principal\VehiculosController;
use App\Http\Controllers\Principal\ReservasController;
use App\Http\Controllers\Principal\UsuariosController;
use App\Http\Controllers\Principal\EmpresasController;
use App\Http\Controllers\Principal\HospedajesController;
use App\Http\Controllers\Principal\PaquetesController;
use App\Http\Controllers\Principal\ViajesController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PagoController;


Route::post('/vehiculos/{id}/pago-ficticio', [PagoController::class, 'storeFicticio'])->name('vehiculos.pago_ficticio');
Route::post('/vehiculos/{id}/reservar', [VehiculosController::class, 'reservar'])->name('vehiculos.reservar');

use App\Http\Controllers\administracionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResultsController;
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
Route::get('/verify-email', [RegisterController::class, 'verifyEmail'])->name('verify.email');

// Vistas estáticas
Route::get('/detalles', function () {
    return view('detalles');
});
use App\Http\Controllers\CartController;
Route::get('/carrito', [CartController::class, 'index'])->name('carrito');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/busqueda', function () {
    return view('busqueda');
});

// Área de administración (requiere auth)
Route::prefix('administracion')->middleware(['auth', 'level:1'])->group(function () {
    Route::get('/',        [administracionController::class, 'inicio'])->name('administracion.inicio');
    Route::get('/reportes', [administracionController::class, 'reportes'])->name('administracion.reportes');


    // Reservar
    Route::get('/reservas',                 [AdminReservasController::class, 'index'])->name('reservas.index');
    Route::post('/reservas/create',         [AdminReservasController::class, 'create'])->name('reservas.create');
    Route::put('/reservas/{reserva}',       [AdminReservasController::class, 'update'])->name('reservas.update');
    Route::delete('/reservas/{reserva}',    [AdminReservasController::class, 'destroy'])->name('reservas.destroy');

    //empresas
    Route::get('/empresas',                 [AdminEmpresasController::class, 'index'])->name('empresas.index');
    Route::post('/empresas/create',         [AdminEmpresasController::class, 'create'])->name('empresas.create');
    Route::put('/empresas/{empresa}',       [AdminEmpresasController::class, 'update'])->name('empresas.update');
    Route::delete('/empresas/{empresa}',    [AdminEmpresasController::class, 'destroy'])->name('empresas.destroy');

    // Vehículos
    Route::get('/vehiculos',                [AdminVehiculosController::class, 'index'])->name('vehiculos.index');
    Route::post('/vehiculos/create',        [AdminVehiculosController::class, 'create'])->name('vehiculos.create');
    Route::put('/vehiculos/{vehiculo}',     [AdminVehiculosController::class, 'update'])->name('vehiculos.update');
    Route::delete('/vehiculos/{vehiculo}',  [AdminVehiculosController::class, 'destroy'])->name('vehiculos.destroy');

    // Hospedajes
    Route::get('/hospedajes',               [AdminHospedajesController::class, 'index'])->name('hospedajes.index');
    Route::post('/hospedajes/create',       [AdminHospedajesController::class, 'create'])->name('hospedajes.create');
    Route::put('/hospedajes/{hospedaje}',   [AdminHospedajesController::class, 'update'])->name('hospedajes.update');
    Route::delete('/hospedajes/{hospedaje}', [AdminHospedajesController::class, 'destroy'])->name('hospedajes.destroy');

    // Paquetes
    Route::get('/paquetes',                 [AdminPaquetesController::class, 'index'])->name('paquetes.index');
    Route::post('/paquetes/create',         [AdminPaquetesController::class, 'create'])->name('paquetes.create');
    Route::put('/paquetes/{paquete}',       [AdminPaquetesController::class, 'update'])->name('paquetes.update');
    Route::delete('/paquetes/{paquete}',    [AdminPaquetesController::class, 'destroy'])->name('paquetes.destroy');


    // Detalle de viaje

    Route::get('/viajes',                   [AdminViajesController::class, 'index'])->name('viajes.index');
    Route::post('/viajes/create',           [AdminViajesController::class, 'create'])->name('viajes.create');
    Route::put('/viajes/{viaje}',           [AdminViajesController::class, 'update'])->name('viajes.update');
    Route::delete('/viajes/{viaje}',        [AdminViajesController::class, 'destroy'])->name('viajes.destroy');


    // Usuarios
    Route::get('/usuarios',                 [AdminUsuariosController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios/create',         [AdminUsuariosController::class, 'create'])->name('usuarios.create');
    Route::put('/usuarios/{user}',          [AdminUsuariosController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}',       [AdminUsuariosController::class, 'destroy'])->name('usuarios.destroy');
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
