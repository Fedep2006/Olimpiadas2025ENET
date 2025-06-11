<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailController extends Controller
{
    public function testEmail()
    {
        try {
            // Configuración de correo
            $config = [
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'username' => config('mail.mailers.smtp.username'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'from_address' => config('mail.from.address'),
                'from_name' => config('mail.from.name')
            ];

            // Enviar un correo de prueba simple
            Mail::raw('Este es un correo de prueba desde Frategar Travel - ' . date('Y-m-d H:i:s'), function($message) {
                $message->to('frategartravel@gmail.com')
                        ->subject('Prueba de correo - Frategar Travel - ' . date('Y-m-d H:i:s'));
            });

            // Registrar en el log
            Log::info('Intento de envío de correo', [
                'config' => $config,
                'destinatario' => 'frategartravel@gmail.com',
                'timestamp' => now()
            ]);

            return response()->json([
                'mensaje' => 'Correo de prueba enviado exitosamente',
                'destinatario' => 'frategartravel@gmail.com',
                'estado' => 'El correo ha sido enviado correctamente',
                'configuracion' => $config,
                'timestamp' => now()
            ]);

        } catch (\Exception $e) {
            Log::error('Error al enviar correo', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Error al enviar el correo: ' . $e->getMessage(),
                'detalles' => $e->getTraceAsString()
            ], 500);
        }
    }
} 