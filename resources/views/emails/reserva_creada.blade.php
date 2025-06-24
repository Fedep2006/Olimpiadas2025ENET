<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Reserva - Frategar</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: #0066cc; color: #fff; padding: 20px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .content h2 { color: #0066cc; font-size: 20px; }
        .content p { color: #555; line-height: 1.6; }
        .reserva-item { border-bottom: 1px solid #eee; padding: 15px 0; }
        .reserva-item:last-child { border-bottom: none; }
        .footer { text-align: center; color: #888; font-size: 12px; padding: 20px; }
        .btn-main { background-color: #ff6600; color: #fff; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Frategar</h1>
        </div>
        <div class="content">
            <h2>¡Gracias por tu reserva, {{ $user->name }}!</h2>
            <p>Hemos confirmado tu reserva y los detalles se muestran a continuación. ¡Esperamos que disfrutes de tu experiencia!</p>

            @foreach ($reservas as $reserva)
                <div class="reserva-item">
                    <p><strong>Código de Reserva:</strong> {{ $reserva->codigo_reserva }}</p>
                    <p><strong>Tipo:</strong> {{ ucfirst($reserva->tipo_reserva) }}</p>
                    <p><strong>Precio Total:</strong> ${{ number_format($reserva->precio_total, 2) }}</p>
                    @if($reserva->fecha_inicio && $reserva->fecha_fin)
                        <p><strong>Desde:</strong> {{ $reserva->fecha_inicio->format('d/m/Y') }} <strong>Hasta:</strong> {{ $reserva->fecha_fin->format('d/m/Y') }}</p>
                    @endif
                </div>
            @endforeach

            <a href="{{ route('mis-compras') }}" class="btn-main">Ver mis compras</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Frategar. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
