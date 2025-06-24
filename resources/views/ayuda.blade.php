<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Ayuda - Frategar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
        }
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--despegar-blue) !important;
        }
        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
        }
        .help-header {
            background: linear-gradient(135deg, var(--despegar-blue) 0%, #004499 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }
        .video-card, .contact-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 25px;
            margin-bottom: 20px;
        }
        .video-card h5 {
            color: var(--despegar-blue);
            font-weight: bold;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            border-radius: 10px;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .contact-card {
            background: var(--despegar-light-blue);
            position: sticky;
            top: 20px;
        }
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }
        .contact-item i {
            font-size: 1.5rem;
            color: var(--despegar-blue);
            margin-right: 15px;
            width: 30px;
            text-align: center;
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
                        <a class="nav-link" href="{{ route('results.index', ['tab' => 'hospedajes']) }}"><i class="fas fa-bed"></i> Hoteles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('results.index', ['tab' => 'paquetes']) }}"><i class="fas fa-suitcase"></i> Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('results.index', ['tab' => 'vehiculos']) }}"><i class="fas fa-car"></i> Autos</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mis-compras') }}"><i class="fas fa-shopping-bag"></i> Mis Compras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('carrito') }}"><i class="fas fa-shopping-cart"></i> Carrito</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ayuda.index') }}"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container py-5">
        <div class="help-header text-center">
            <h1 class="display-5">Centro de Ayuda</h1>
            <p class="lead">Encuentra respuestas a tus preguntas y aprende a usar nuestra plataforma.</p>
        </div>

        <div class="row">
            <!-- Columna de Videos -->
            <div class="col-lg-8">
                <div class="video-card">
                    <h5 class="mb-3">Cómo realizar una búsqueda</h5>
                    <div class="video-container mb-4">
                        <!-- Reemplazar con ID de video de YouTube -->
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <p>Aprende a encontrar los mejores vuelos, hoteles y paquetes usando nuestros filtros de búsqueda avanzada.</p>
                </div>
                <div class="video-card">
                    <h5 class="mb-3">Gestionar tus reservas</h5>
                    <div class="video-container mb-4">
                        <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <p>Descubre cómo ver, modificar o cancelar tus compras desde la sección "Mis Compras".</p>
                </div>
            </div>

            <!-- Columna de Contacto -->
            <div class="col-lg-4">
                <div class="contact-card">
                    <h4 class="mb-4 text-center" style="color: var(--despegar-blue);">¿Necesitas más ayuda?</h4>
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <strong>Atención Telefónica</strong><br>
                            <span class="text-muted">+54 11 4000-1234</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-whatsapp"></i>
                        <div>
                            <strong>WhatsApp</strong><br>
                            <span class="text-muted">+54 9 11 5555-6789</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong><br>
                            <span class="text-muted">ayuda@frategar.com</span>
                        </div>
                    </div>
                    <hr class="my-4">
                    <p class="text-center text-muted small">Nuestro equipo de soporte está disponible 24/7 para ayudarte.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
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
                        <li><a href="{{ route('ayuda.index') }}" class="text-light text-decoration-none">Centro de ayuda</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-6 mb-4 text-end">
                    <h5>Síguenos</h5>
                    <div class="d-flex gap-3 justify-content-end">
                        <a href="#" class="text-light"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram fa-2x"></i></a>
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
