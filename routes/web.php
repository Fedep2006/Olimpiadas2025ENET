<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Admin Controllers
use App\Http\Controllers\Admin\{
    AdminContenidoController,
    AdminUsuariosController,
    AdminEmpresasController,
    AdminHospedajesController,
    AdminPaquetesController,
    AdminReservasController,
    AdminVehiculosController,
    AdminViajesController,
    ContenidoController
};

// Principal Controllers
use App\Http\Controllers\Principal\{
    ReservasController,
    UsuariosController,
    EmpresasController,
    HospedajesController,
    PaquetesController,
    ViajesController,
    VehiculosController
};

// Other Controllers
use App\Http\Controllers\{
    DetalleController,
    PagoController,
    administracionController,
    AuthController,
    RegisterController,
    ResultsController,
    TestCompraController,
    TestGmailController,
    TestEmailController,
    CartController,
    ComprasController,
    HelpController
};

// Modelos
use App\Models\User;
use App\Models\Viaje;
use App\Models\Hospedaje;
use App\Models\Vehiculo;
use App\Models\Paquete;

// Ruta de búsqueda unificada de texto y filtros avanzados
Route::get('/results', [ResultsController::class, 'index'])
    ->name('results.index');

// Rutas de reserva de vehículos
Route::post('/vehiculos/{id}/reservar', [\App\Http\Controllers\Principal\VehiculosController::class, 'reservar'])
    ->name('vehiculos.reservar')
    ->middleware('auth');

// Rutas del carrito
Route::get('/carrito', [CartController::class, 'index'])->name('carrito');
Route::post('/carrito/hospedaje/{id}', [CartController::class, 'addHospedaje'])->name('carrito.hospedaje.add');
Route::post('/carrito/viaje/{id}', [CartController::class, 'addViaje'])->name('carrito.viaje.add');
Route::post('/carrito/vehiculo/{id}', [CartController::class, 'addVehiculo'])->name('carrito.vehiculo.add');
Route::post('/carrito/paquete/{id}', [CartController::class, 'addPaquete'])->name('carrito.paquete.add');

// Operaciones del carrito (AJAX)
Route::post('/carrito/remove', [CartController::class, 'removeFromCart'])->name('carrito.remove');
Route::post('/carrito/update', [CartController::class, 'updateCartItem'])->name('carrito.update');
Route::post('/carrito/clear', [CartController::class, 'clearCart'])->name('carrito.clear');

// Procesar compra del carrito
Route::post('/carrito/checkout', [CartController::class, 'checkout'])->name('carrito.checkout')->middleware('auth');

// Reservar hospedaje directamente
Route::post('/reservar/hospedaje/{id}', [ReservasController::class, 'reservarHospedaje'])->name('reservar.hospedaje');

// Ruta para procesar la reserva de un hospedaje con paquete dinámico
Route::post('/hospedajes/reservar', [App\Http\Controllers\Principal\HospedajesController::class, 'storeReserva'])->name('hospedajes.storeReserva')->middleware('auth');
Route::get('/hospedajes/{id}', [App\Http\Controllers\Principal\HospedajesController::class, 'show'])->name('hospedajes.show');

// Página de inicio
Route::get('/', function (Request $request) {
    $paquetes = Paquete::where('hecho_por_usuario', '!=', 1)
        ->where('activo', 1)
        ->get();
    $hospedajes = Hospedaje::all();
    $viajes = Viaje::all();
    $vehiculos = Vehiculo::all();
    return view('index', compact('paquetes', 'hospedajes', 'viajes', 'vehiculos'));
})->name('home');

// Detalles de un vehículo
Route::get('/vehiculos/{id}', [VehiculosController::class, 'show'])->name('vehiculos.show');

// Detalles de un paquete
Route::get('/paquetes/{id}', [PaquetesController::class, 'show'])->name('paquetes.show');

// Detalles de un viaje
Route::get('/viajes/{id}', [ViajesController::class, 'show'])->name('viajes.show');

// Detalles de un recurso
Route::get('/details/{tipo}/{id}', [DetalleController::class, 'show'])->name('details.show');

// Procesar reserva
Route::post('/reservar', [DetalleController::class, 'store'])->name('reservar.store')->middleware('auth');

// Mis Compras
Route::get('/mis-compras', [ComprasController::class, 'index'])->name('mis-compras')->middleware('auth');
Route::post('/mis-compras/{reserva}/cancelar', [ComprasController::class, 'cancelar'])->name('mis-compras.cancelar')->middleware('auth');
Route::get('/mis-compras/{reserva}/editar', [ComprasController::class, 'edit'])->name('mis-compras.edit')->middleware('auth');
Route::put('/mis-compras/{reserva}', [ComprasController::class, 'update'])->name('mis-compras.update')->middleware('auth');
Route::get('/mis-compras/{reserva}/modificar', [ComprasController::class, 'modificar'])->name('mis-compras.modificar')->middleware('auth');

// Ayuda
Route::get('/ayuda', [HelpController::class, 'index'])->name('ayuda.index');

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

    Route::get('/paquetes/contenidos',                 [AdminContenidoController::class, 'index'])->name('paquetes.index');
    Route::post('/paquetes/contenidos/create',         [AdminContenidoController::class, 'create'])->name('paquetes.create');
    Route::put('/paquetes/contenidos/{paquete}',       [AdminContenidoController::class, 'update'])->name('paquetes.update');
    Route::delete('/paquetes/contenidos/{paquete}',    [AdminContenidoController::class, 'destroy'])->name('paquetes.destroy');

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
