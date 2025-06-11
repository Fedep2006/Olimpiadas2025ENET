<?php

namespace App\Http\Controllers;

use App\Models\CompraPaquete;
use App\Models\Paquete;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestGmailController extends Controller
{
    public function testGmail()
    {
        try {
            // 1. Obtener un usuario de prueba
            $usuario = User::first();
            if (!$usuario) {
                return response()->json([
                    'error' => 'No hay usuarios en el sistema'
                ], 404);
            }

            // 2. Crear una compra de prueba
            $compra = CompraPaquete::create([
                'usuario_id' => $usuario->id,
                'paquete_id' => 1, // Asegúrate de que exista este ID
                'total' => 1500.00,
                'estado' => 'pendiente'
            ]);

            // 3. Enviar notificación de prueba
            $usuario->notify(new \App\Notifications\CompraConfirmada($compra));

            return response()->json([
                'mensaje' => 'Correo de prueba enviado exitosamente',
                'destinatario' => $usuario->email,
                'estado' => 'El correo ha sido enviado a: ' . $usuario->email
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al enviar el correo: ' . $e->getMessage()
            ], 500);
        }
    }
} 