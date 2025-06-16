<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva enviada - Frategar</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,102,204,0.08); padding: 32px; }
        .header { background: #0066cc; color: #fff; padding: 24px 0; border-radius: 12px 12px 0 0; text-align: center; }
        .header h1 { margin: 0; font-size: 2rem; }
        .content { padding: 32px 0; text-align: center; }
        .content h2 { color: #0066cc; }
        .content p { color: #333; font-size: 1.1rem; }
        .footer { text-align: center; color: #888; font-size: 0.9rem; margin-top: 32px; }
        .btn-main { background: linear-gradient(135deg, #ff6600, #ff8533); color: #fff; padding: 12px 32px; border-radius: 40px; text-decoration: none; font-weight: bold; display: inline-block; margin-top: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Frategar</h1>
        </div>
        <div class="content">
            <h2>¡Reserva enviada!</h2>
            <p>Tu solicitud de reserva fue recibida correctamente.<br>
            En breve te notificaremos por este medio si la reserva fue <b>aceptada</b> o <b>rechazada</b> junto con el motivo correspondiente.</p>
            <p style="margin-top: 32px; font-size: 1.05rem;">
                <b>Detalle del vehículo:</b><br>
                Marca: <b>{{ $vehiculo->marca }}</b><br>
                Modelo: <b>{{ $vehiculo->modelo }}</b><br>
                Fecha de inicio: <b>{{ $reserva->fecha_inicio }}</b><br>
                Fecha de fin: <b>{{ $reserva->fecha_fin }}</b><br>
                Precio total: <b>${{ number_format($reserva->precio_total, 2) }}</b>
            </p>
            <a href="{{ url('/') }}" class="btn-main">Ir a Frategar</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Frategar. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
