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
        .reserva-item { border: 1px solid #eee; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .footer { text-align: center; color: #888; font-size: 12px; padding: 20px; }
        .btn-main { background-color: #ff6600; color: #fff; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; display: inline-block; margin-top: 20px; }
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .detail-label { font-weight: bold; color: #333; }
        .detail-value { color: #666; }
        .price { font-size: 24px; color: #ff6600; font-weight: bold; text-align: center; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Frategar</h1>
        </div>
        <div class="content">
            <h2>¡Gracias por tu reserva, {{ $reserva->usuario->name }}!</h2>
            <p>Hemos confirmado tu reserva y los detalles se muestran a continuación. ¡Esperamos que disfrutes de tu experiencia!</p>

            <div class="reserva-item">
                <div class="detail-row">
                    <span class="detail-label">Código de Reserva:</span>
                    <span class="detail-value">{{ $reserva->codigo_reserva }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Tipo:</span>
                    <span class="detail-value">{{ ucfirst($reserva->tipo_reserva) }}</span>
                </div>
                @if($reserva->fecha_inicio && $reserva->fecha_fin)
                    <div class="detail-row">
                        <span class="detail-label">Fecha de Inicio:</span>
                        <span class="detail-value">{{ $reserva->fecha_inicio->format('d/m/Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Fecha de Fin:</span>
                        <span class="detail-value">{{ $reserva->fecha_fin->format('d/m/Y') }}</span>
                    </div>
                @endif
                <div class="detail-row">
                    <span class="detail-label">Estado:</span>
                    <span class="detail-value">{{ ucfirst($reserva->estado) }}</span>
                </div>
                @if($reserva->paquete)
                    <div class="detail-row">
                        <span class="detail-label">Paquete:</span>
                        <span class="detail-value">{{ $reserva->paquete->nombre }}</span>
                    </div>
                @endif
                <div class="price">
                    ${{ number_format($reserva->precio_total, 2) }}
                </div>
            </div>

            <p style="text-align: center;">
                <a href="{{ route('mis-compras') }}" class="btn-main">Ver mis compras</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Frategar. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
