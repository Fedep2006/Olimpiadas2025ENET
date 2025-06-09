<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/dashboard', function () {
    return view('administracion.dashboard-index'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/dashboard/reservas', function () {
    return view('administracion.dashboard-reservas'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/dashboard/usuarios', function () {
    return view('administracion.dashboard-usuarios'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/dashboard/vuelos', function () {
    return view('administracion.dashboard-vuelos'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/dashboard/promociones', function () {
    return view('administracion.dashboard-promociones'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/dashboard/reportes', function () {
    return view('administracion.dashboard-reportes'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/dashboard/autos', function () {
    return view('administracion.dashboard-autos'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/dashboard/configuracion', function () {
    return view('administracion.dashboard-configuracion'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/dashboard/hoteles', function () {
    return view('administracion.dashboard-hoteles'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/busqueda', function () {
    return view('busqueda'); // Make sure resources/views/login/register.blade.php exists
});