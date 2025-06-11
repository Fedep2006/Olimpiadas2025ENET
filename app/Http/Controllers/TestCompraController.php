<?php

namespace App\Http\Controllers;

use App\Models\CompraPaquete;
use App\Models\Paquete;
use App\Models\User;
use Illuminate\Http\Request;

class TestCompraController extends Controller
{
    public function simularCompra()
    {
        try {
            // 1. Obtener un usuario de prueba (el primero que encontremos)
            $usuario = User::first();
            if (!$usuario) {
                return response()->json([
                    'error' => 'No hay usuarios en el sistema'
                ], 404);
            }

            // 2. Obtener un paquete de prueba
            $paquete = Paquete::first();
            if (!$paquete) {
                return response()->json([
                    'error' => 'No hay paquetes en el sistema'
                ], 404);
            }

            // 3. Crear una compra de prueba
            $compra = CompraPaquete::create([
                'usuario_id' => $usuario->id,
                'paquete_id' => $paquete->id,
                'total' => 1500.00,
                'estado' => 'pendiente'
            ]);

            // 4. Confirmar la compra (esto enviará la primera notificación)
            $compra->confirmar();

            // 5. Simular una actualización de estado (esto enviará la segunda notificación)
            $compra->actualizarEstado('en_proceso');

            return response()->json([
                'mensaje' => 'Compra simulada exitosamente',
                'compra' => $compra,
                'usuario' => $usuario->email,
                'estado' => 'Las notificaciones han sido enviadas al correo: ' . $usuario->email
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al simular la compra: ' . $e->getMessage()
            ], 500);
        }
    }
} 