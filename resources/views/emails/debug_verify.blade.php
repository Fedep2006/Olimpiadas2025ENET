
    /** @var bool $found */
    /** @var string|null $email */
    /** @var string|null $token */
    /** @var \App\Models\User|null $user */
    /** @var array|null $before */
    /** @var array|null $after */
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Debug Verificación de Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="mb-4">Debug: Verificación de Email</h2>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Token:</strong> {{ $token }}</p>
            @if(!$found)
                <div class="alert alert-danger">Usuario <strong>NO encontrado</strong> con este email y token.</div>
            @else
                <div class="alert alert-success">Usuario encontrado y actualizado.</div>
                <h5>Estado <span class="text-danger">ANTES</span> de verificar:</h5>
                <ul>
                    <li><strong>email_verified_at:</strong> {{ $before['email_verified_at'] ?? 'null' }}</li>
                    <li><strong>verification_token:</strong> {{ $before['verification_token'] ?? 'null' }}</li>
                </ul>
                <h5>Estado <span class="text-success">DESPUÉS</span> de verificar:</h5>
                <ul>
                    <li><strong>email_verified_at:</strong> {{ $after['email_verified_at'] ?? 'null' }}</li>
                    <li><strong>verification_token:</strong> {{ $after['verification_token'] ?? 'null' }}</li>
                </ul>
            @endif
            <a href="/login" class="btn btn-primary mt-3">Ir al login</a>
        </div>
    </div>
</div>
</body>
</html>
