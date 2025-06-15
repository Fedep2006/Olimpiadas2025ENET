<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>¡Verifica tu correo en Frategar!</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto;">
        <tr>
            <td style="padding: 20px; text-align: center; background-color: #2E86C1; color: #fff;">
                <h1 style="margin: 0;">¡Bienvenido a Frategar!</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px; background-color: #f9f9f9;">
                <p>Hola, <strong>{{ $user->name }}</strong>:</p>
                <p>¡Gracias por unirte a <strong>Frategar</strong>! Prepárate para descubrir destinos increíbles y planificar viajes inolvidables.</p>
                <p>Para activar tu cuenta y empezar a explorar, haz clic en el botón a continuación:</p>
                <p style="text-align: center;">
                    <a href="{{ $verificationUrl }}" style="display: inline-block; background-color: #28A745; color: #fff; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">Verificar mi correo</a>
                </p>
                <p>Si el botón no funcionara, copia y pega este enlace en tu navegador:</p>
                <p style="word-break: break-all;"><a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a></p>
                <p>Si no solicitaste esta verificación, puedes ignorar este correo sin problemas.</p>
                <br>
                <p>¡Buen viaje!<br>
                El equipo de <strong>Frategar</strong></p>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px; text-align: center; font-size: 12px; color: #777;">
                <p>© 2025 Frategar. Todos los derechos reservados.</p>
            </td>
        </tr>
    </table>
</body>
</html>
