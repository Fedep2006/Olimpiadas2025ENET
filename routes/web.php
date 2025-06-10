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
Route::get('/administracion', function () {
    return view('administracion.inicio'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/administracion/reservas', function () {
    return view('administracion.reservas'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/administracion/usuarios', function () {
    return view('administracion.usuarios'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/administracion/vuelos', function () {
    return view('administracion.vuelos'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/administracion/promociones', function () {
    return view('administracion.promociones'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/administracion/reportes', function () {
    return view('administracion.reportes'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/administracion/autos', function () {
    return view('administracion.autos'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/administracion/configuracion', function () {
    return view('administracion.configuracion'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/administracion/hoteles', function () {
    return view('administracion.hoteles'); // Make sure resources/views/login/register.blade.php exists
});
Route::get('/busqueda', function () {
    return view('busqueda'); // Make sure resources/views/login/register.blade.php exists
});
