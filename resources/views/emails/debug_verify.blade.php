

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
