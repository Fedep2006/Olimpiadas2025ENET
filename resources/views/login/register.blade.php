<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Frategar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
        }
        
        body {
            background: linear-gradient(135deg, var(--despegar-light-blue) 0%, #f8f9fa 100%);
            min-height: 100vh;
        }
        
            .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--despegar-blue) !important;
        }
        
        .register-container {
            min-height: calc(100vh - 200px);
            display: flex;
            align-items: center;
            padding: 40px 0;
        }
        
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-header h2 {
            color: var(--despegar-blue);
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .register-header p {
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
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }
        
        .form-control.is-valid {
            border-color: #28a745;
        }
        
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px 0 0 10px;
            color: var(--despegar-blue);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--despegar-blue);
        }
        
        .btn-register {
            background-color: var(--despegar-blue);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: bold;
            color: white;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            background-color: #0052a3;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-register:disabled {
            background-color: #6c757d;
            transform: none;
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
            border-color: var(--despegar-blue);
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
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #e9ecef;
        }
        
        .login-link a {
            color: var(--despegar-blue);
            text-decoration: none;
            font-weight: bold;
        }
        
        .login-link a:hover {
            color: var(--despegar-orange);
            text-decoration: underline;
        }
        
        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            margin-top: auto;
        }
        
        .benefits {
            background: var(--despegar-light-blue);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .benefits h6 {
            color: var(--despegar-blue);
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
            color: var(--despegar-blue);
            margin-right: 10px;
            width: 16px;
        }
        
        .password-strength {
            margin-top: 5px;
        }
        
        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background-color: #e9ecef;
            overflow: hidden;
        }
        
        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        
        .strength-weak { background-color: #dc3545; width: 25%; }
        .strength-fair { background-color: #ffc107; width: 50%; }
        .strength-good { background-color: #17a2b8; width: 75%; }
        .strength-strong { background-color: #28a745; width: 100%; }
        
        .strength-text {
            font-size: 12px;
            margin-top: 2px;
        }
        
        .form-text {
            font-size: 12px;
            color: #6c757d;
        }
        
        .form-text.text-success {
            color: #28a745 !important;
        }
        
        .form-text.text-danger {
            color: #dc3545 !important;
        }
        
        .terms-link {
            color: var(--despegar-blue);
            text-decoration: none;
        }
        
        .terms-link:hover {
            color: var(--despegar-orange);
            text-decoration: underline;
        }
    </style>
</head>
<body>

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
                        <a class="nav-link" href="#"><i class="fas fa-plane"></i> Vuelos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-bed"></i> Hoteles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-suitcase"></i> Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-car"></i> Autos</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fas fa-user"></i> Mi cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Register Section -->
    <div class="register-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="register-card">
                        <!-- Header -->
                        <div class="register-header">
                            <h2>¡Creá tu cuenta gratis!</h2>
                            <p>Registrate y comenzá a disfrutar de todos los beneficios</p>
                        </div>

                        <!-- Benefits -->

                        <!-- Register Form -->
                        <form id="registerForm" action="{{ route('register.process') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre" value="{{ old('name') }}" required maxlength="255">
                                </div>
                                <div class="form-text" id="firstNameFeedback"></div>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="tu@email.com" value="{{ old('email') }}" required maxlength="255">
                                </div>
                                <div class="form-text" id="emailFeedback"></div>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Creá una contraseña segura" required minlength="6">
                                </div>
                                <div class="password-strength">
                                    <div class="strength-bar">
                                        <div class="strength-fill" id="strengthBar"></div>
                                    </div>
                                    <div class="strength-text" id="strengthText"></div>
                                </div>
                                <div class="form-text">Mínimo 6 caracteres, incluye mayúsculas, minúsculas y números</div>
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Repetí tu contraseña" required minlength="6">
                                </div>
                                <div class="form-text" id="confirmPasswordFeedback"></div>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Acepto los <a href="{{ route('terminos') }}" class="text-muted">Términos y Condiciones Política y la de Privacidad</a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-register" id="registerBtn">
                                <i class="fas fa-user-plus me-2"></i>Crear mi cuenta
                            </button>
                        </form>
                        @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                        @endif

                        <!-- Login Link -->
                        <div class="login-link">
                            <p class="mb-0">¿Ya tenés cuenta? <a href="/login">Iniciá sesión</a></p>
                        </div>
                    </div>
                </div>

                <!-- Side Information -->
                <div class="col-lg-4 col-md-5 d-none d-md-block">
                    <div class="ms-4">
                        <h3 class="text-primary fw-bold mb-4">¡Únete a millones de viajeros!</h3>
                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3">
                                <i class="fas fa-medal fa-2x text-warning"></i>
                            </div>
                            <div>
                                <h5>Empresa líder</h5>
                                <p class="text-muted">Reconocida como la mejor plataforma de viajes online.</p>
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
                        <li><a href="#" class="text-light text-decoration-none">Vuelos</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Hoteles</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Paquetes</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Autos</a></li>
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

<!-- aaron rompio todo, hasta mi corazon-->