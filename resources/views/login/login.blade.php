<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Frategar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --frategar-blue: #0066cc;
            --frategar-orange: #ff6600;
            --frategar-light-blue: #e6f3ff;
        }

        body {
            background: linear-gradient(135deg, var(--frategar-light-blue) 0%, #f8f9fa 100%);
            min-height: 100vh;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--frategar-blue) !important;
        }

        .login-container {
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 450px;
            width: 100%;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: var(--frategar-blue);
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--frategar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px 0 0 10px;
            color: var(--frategar-blue);
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--frategar-blue);
        }

        .btn-login {
            background-color: var(--frategar-blue);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: bold;
            color: white;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0052a3;
            color: white;
            transform: translateY(-2px);
        }

        .btn-social {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 10px;
            width: 100%;
            background: white;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            border-color: var(--frategar-blue);
            transform: translateY(-2px);
        }

        .btn-google {
            color: #db4437;
        }

        .btn-facebook {
            color: #4267B2;
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 25px 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e9ecef;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #6c757d;
            font-size: 14px;
        }

        .forgot-password {
            color: var(--frategar-blue);
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password:hover {
            color: var(--frategar-orange);
            text-decoration: underline;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e9ecef;
        }

        .register-link a {
            color: var(--frategar-blue);
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            color: var(--frategar-orange);
            text-decoration: underline;
        }

        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            margin-top: auto;
        }

        .benefits {
            background: var(--frategar-light-blue);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .benefits h6 {
            color: var(--frategar-blue);
            font-weight: bold;
            margin-bottom: 15px;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .benefit-item i {
            color: var(--frategar-blue);
            margin-right: 10px;
            width: 16px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-plane text-primary"></i> Frategar
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('results.index', ['tab' => 'viajes']) }}"><i class="fas fa-plane"></i> Vuelos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('results.index', ['tab' => 'hospedajes']) }}"><i class="fas fa-hotel"></i> Hoteles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('results.index', ['tab' => 'paquetes']) }}"><i class="fas fa-box"></i> Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('results.index', ['tab' => 'vehiculos']) }}"><i class="fas fa-car"></i> Autos</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i> Mi cuenta</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ayuda.index') }}"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="login-card">
                        <!-- Header -->
                        <div class="login-header">
                            <h2>¡Bienvenido de vuelta!</h2>
                            <p>Iniciá sesión para acceder a tu cuenta</p>
                        </div>

                        <!-- Benefits -->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.process') }}">
                            @csrf
                            @if(request()->has('redirect_to'))
                                <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">
                            @endif
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="tu@email.com" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Tu contraseña" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="hidden" name="remember" value="0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        value="1">
                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>
                                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                            </div>

                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </button>
                        </form>

                        <!-- Register Link -->
                        <div class="register-link">
                            <p class="mb-0">¿No tenés cuenta? <a href="/register">Registrate gratis</a></p>
                        </div>
                    </div>
                </div>



                <!-- Side Information -->
                <div class="col-lg-4 col-md-5 d-none d-md-block">
                    <div class="ms-4">
                        <h3 class="text-primary fw-bold mb-4">¿Por qué elegir Frategar?</h3>

                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3">
                                <i class="fas fa-shield-alt fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h5>Compra protegida</h5>
                                <p class="text-muted">Tu dinero está protegido con nosotros. Comprá con total
                                    tranquilidad.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3">
                                <i class="fas fa-percent fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h5>Mejores precios</h5>
                                <p class="text-muted">Garantizamos el mejor precio. Si encontrás uno mejor, te
                                    devolvemos la diferencia.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3">
                                <i class="fas fa-headset fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h5>Atención 24/7</h5>
                                <p class="text-muted">Te ayudamos cuando lo necesites, todos los días del año.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5>Frategar</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Quiénes somos</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Trabaja con nosotros</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Prensa</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Inversores</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5>Productos</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('results.index', ['tab' => 'viajes']) }}" class="text-light text-decoration-none">Vuelos</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'hospedajes']) }}" class="text-light text-decoration-none">Hoteles</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'paquetes']) }}" class="text-light text-decoration-none">Paquetes</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'vehiculos']) }}" class="text-light text-decoration-none">Autos</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5>Ayuda</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Centro de ayuda</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Contacto</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Términos y condiciones</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Privacidad</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5>Síguenos</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2025 Frategar. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
