<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Mostrar el carrito
    public function index(Request $request)
    {
        $cart = session('cart', []);
        return view('login.carrito', compact('cart'));
    }

    // Agregar producto al carrito
    public function add(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $precio = $request->input('precio');
        $cantidad = $request->input('cantidad', 1);
        $descripcion = $request->input('descripcion', null);
        $imagen = $request->input('imagen', null);

        if(isset($cart[$id])) {
            $cart[$id]['cantidad'] += $cantidad;
        } else {
            $cart[$id] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad,
                'descripcion' => $descripcion,
                'imagen' => $imagen,
            ];
        }
        session(['cart' => $cart]);
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    // Actualizar cantidad
    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->input('id');
        $cantidad = $request->input('cantidad', 1);
        if(isset($cart[$id])) {
            $cart[$id]['cantidad'] = $cantidad;
            session(['cart' => $cart]);
        }
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    // Eliminar producto
    public function remove(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->input('id');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    // Vaciar carrito
    public function clear(Request $request)
    {
        session(['cart' => []]);
        return response()->json(['success' => true]);
    }
}
