<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras - Frategar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
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

        /* Estilos específicos para Mis Compras */
        .page-title {
            color: var(--despegar-blue);
            font-weight: bold;
            margin-bottom: 2rem;
        }

        .purchase-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .purchase-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .purchase-icon {
            color: var(--despegar-blue);
            opacity: 0.8;
        }

        .status-badge {
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .empty-state {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            border: 2px dashed #dee2e6;
        }

        .empty-state i {
            color: var(--despegar-blue);
            opacity: 0.6;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--despegar-blue), #0052a3);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0052a3, var(--despegar-blue));
            transform: translateY(-1px);
        }

        .btn-outline-primary {
            border-color: var(--despegar-blue);
            color: var(--despegar-blue);
            border-radius: 20px;
        }

        .btn-outline-primary:hover {
            background-color: var(--despegar-blue);
            border-color: var(--despegar-blue);
        }

        .btn-outline-danger {
            border-radius: 20px;
        }

        .alert {
            border-radius: 15px;
            border: none;
        }

        .price-highlight {
            color: var(--despegar-orange);
            font-weight: bold;
            font-size: 1.1rem;
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
                <ul class="navbar-nav align-items-center">
                    <!-- Carrito -->
                    <li class="nav-item">
                        <a href="{{ route('carrito') }}" class="nav-link position-relative" title="Carrito">
                            <i class="fas fa-shopping-cart"></i>
                            @php
                                $carrito = session('carrito', []);
                                $totalItems = is_array($carrito) ? array_sum(array_column($carrito, 'cantidad')) : 0;
                            @endphp
                            @if($totalItems > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.7rem;">
                                    {{ $totalItems }}
                                </span>
                            @endif
                        </a>
                    </li>

                    @auth
                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('mis-compras') }}">
                                        <i class="fas fa-shopping-bag me-1"></i> Mis Compras
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Mi Cuenta -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-user"></i> Mi cuenta</a>
                        </li>
                    @endauth

                    <!-- Ayuda -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal - Mis Compras -->
    <div class="container py-5">
        <h1 class="page-title">
            <i class="fas fa-shopping-bag me-3"></i>Mis Compras
        </h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($reservas->isEmpty())
            <div class="empty-state">
                <i class="fas fa-shopping-bag fa-4x mb-4"></i>
                <h4 class="mb-3">Aún no has realizado ninguna compra.</h4>
                <p class="text-muted mb-4">¡Explora nuestros productos y encuentra tu próxima aventura!</p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i>Ir a la página principal
                </a>
            </div>
        @else
            <div class="row">
                @foreach($reservas as $reserva)
                    @php
                        $item = $reserva->reservable ?? $reserva->paquete;
                        $tipo = $reserva->reservable_type ? class_basename($reserva->reservable_type) : ($reserva->paquete ? 'Paquete' : 'Desconocido');
                        $icon = 'fa-box'; // Icono por defecto
                        if ($tipo == 'Viaje') $icon = 'fa-plane-departure';
                        if ($tipo == 'Hospedaje') $icon = 'fa-hotel';
                        if ($tipo == 'Vehiculo') $icon = 'fa-car';
                        if ($tipo == 'Paquete') $icon = 'fa-suitcase-rolling';
                        
                        $statusClass = 'warning';
                        if ($reserva->estado == 'completado') $statusClass = 'success';
                        if ($reserva->estado == 'cancelado') $statusClass = 'danger';
                    @endphp
                    
                    <div class="col-12 mb-4">
                        <div class="card purchase-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="text-center" style="width: 80px;">
                                            <i class="fas {{ $icon }} fa-3x purchase-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0">{{ $item->nombre ?? 'Producto no disponible' }}</h5>
                                            <span class="badge bg-{{ $statusClass }} status-badge">
                                                {{ ucfirst($reserva->estado) }}
                                            </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="card-text mb-2">
                                                    <strong><i class="fas fa-tag me-1"></i>Tipo:</strong> {{ $tipo }}
                                                </p>
                                                <p class="card-text mb-2">
                                                    <strong><i class="fas fa-calendar-alt me-1"></i>Fechas:</strong> 
                                                    {{ $reserva->fecha_inicio->format('d/m/Y') }} - {{ $reserva->fecha_fin->format('d/m/Y') }}
                                                </p>
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <h6 class="price-highlight mb-0">
                                                    <i class="fas fa-dollar-sign me-1"></i>Total: ${{ number_format($reserva->precio_total, 2) }}
                                                </h6>
                                            </div>
                                        </div>
                                        
                                        @if($reserva->estado == 'pendiente')
                                            <div class="mt-3 pt-3 border-top text-end">
                                                <a href="{{ route('mis-compras.modificar', $reserva) }}" class="btn btn-outline-primary btn-sm me-2">
                                                    <i class="fas fa-edit me-1"></i>Modificar Reserva
                                                </a>
                                                <form action="{{ route('mis-compras.cancelar', $reserva) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que quieres cancelar esta reserva?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-times me-1"></i>Cancelar Reserva
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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
                        <li><a href="#" class="text-light text-decoration-none">Contacto</a></li>
                        <li><a href="{{ route("terminos") }}" class="text-light text-decoration-none">Términos y condiciones</a></li>
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

    <script>
        // Bloque de debug para Bootstrap y dropdown
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Bootstrap:', typeof bootstrap !== 'undefined' ? 'Cargado' : 'NO cargado');
            var dropdown = document.querySelector('.dropdown-toggle');
            var menu = document.querySelector('.dropdown-menu');
            if (dropdown && menu) {
                dropdown.addEventListener('click', function(e) {
                    e.preventDefault();
                    menu.classList.toggle('show');
                    console.log('Clase show toggled en dropdown-menu');
                });
            }
        });
    </script>
</body>
</html>