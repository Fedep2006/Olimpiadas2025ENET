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

        .purchase-card .card-body {
            padding: 1.3rem 1rem; /* Aumenta el padding vertical para más altura */
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
                        <a class="nav-link" href="{{ route('ayuda.index') }}"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal - Mis Compras -->
    <div class="container my-5">

    <h1 class="page-title text-center">Mis Compras</h1>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($reservas_pendientes->isEmpty() && $reservas_aceptadas->isEmpty() && $reservas_canceladas->isEmpty())
        <div class="empty-state">
            <i class="fas fa-shopping-bag fa-4x mb-4"></i>
            <h2>Aún no tienes compras</h2>
            <p class="lead text-muted">Parece que todavía no has realizado ninguna reserva. ¡Explora nuestros destinos y encuentra tu próxima aventura!</p>
            <a href="/" class="btn btn-primary mt-3">
                <i class="fas fa-search me-2"></i>Buscar ofertas
            </a>
        </div>
    @else
        <!-- Pestañas de Navegación -->
        <ul class="nav nav-tabs nav-pills nav-fill mb-4" id="comprasTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pendientes-tab" data-bs-toggle="tab" data-bs-target="#pendientes" type="button" role="tab" aria-controls="pendientes" aria-selected="true">
                    <i class="fas fa-clock me-2"></i>Pendientes <span class="badge bg-warning text-dark ms-1">{{ $reservas_pendientes->count() }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="aceptadas-tab" data-bs-toggle="tab" data-bs-target="#aceptadas" type="button" role="tab" aria-controls="aceptadas" aria-selected="false">
                    <i class="fas fa-check-circle me-2"></i>Confirmadas <span class="badge bg-success ms-1">{{ $reservas_aceptadas->count() }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="canceladas-tab" data-bs-toggle="tab" data-bs-target="#canceladas" type="button" role="tab" aria-controls="canceladas" aria-selected="false">
                    <i class="fas fa-times-circle me-2"></i>Canceladas <span class="badge bg-danger ms-1">{{ $reservas_canceladas->count() }}</span>
                </button>
            </li>
        </ul>

        <!-- Contenido de las Pestañas -->
        <div class="tab-content" id="comprasTabContent">
            <!-- Pestaña Pendientes -->
            <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
                @if($reservas_pendientes->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-inbox fa-4x mb-4"></i>
                        <h2>No tienes reservas pendientes</h2>
                        <p class="lead text-muted">Cuando realices una nueva reserva, aparecerá aquí mientras se procesa.</p>
                    </div>
                @else
                    <div class="row">
                        @foreach($reservas_pendientes as $reserva)
                            <div class="col-lg-12">
                                <div class="purchase-card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 text-center">
                                                @php
                                                    $iconClass = 'fa-question-circle';
                                                    if ($reserva->reservable_type === 'App\\Models\\Hospedaje') $iconClass = 'fa-bed';
                                                    if ($reserva->reservable_type === 'App\\Models\\Viaje') $iconClass = 'fa-plane';
                                                    if ($reserva->reservable_type === 'App\\Models\\Vehiculo') $iconClass = 'fa-car';
                                                    if ($reserva->tipo_reserva === 'paquete') $iconClass = 'fa-box';
                                                @endphp
                                                <i class="fas {{ $iconClass }} fa-3x purchase-icon"></i>
                                            </div>
                                            <div class="col-md-7">
                                                <h5 class="card-title mb-1">
                                                    @if($reserva->paquete)
                                                        {{ $reserva->paquete->nombre }}
                                                    @else
                                                        {{ $reserva->reservable->nombre ?? 'Reserva ' . $reserva->codigo_reserva }}
                                                    @endif
                                                </h5>
                                                <p class="card-text text-muted mb-2">
                                                    Código de reserva: <strong>{{ $reserva->codigo_reserva }}</strong>
                                                </p>
                                                <p class="card-text text-muted">
                                                    Fecha de compra: {{ $reserva->created_at->format('d/m/Y') }}
                                                </p>
                                            </div>
                                            <div class="col-md-3 text-md-end">
                                                <p class="price-highlight mb-2">
                                                    ARS {{ number_format($reserva->precio_total, 2, ',', '.') }}
                                                </p>
                                                <div>
                                                    @php
                                                        $estado = $reserva->estado;
                                                        $badgeClass = 'bg-warning text-dark';
                                                    @endphp
                                                    <span class="badge status-badge {{ $badgeClass }}">{{ ucfirst($estado) }}</span>
                                                </div>
                                                @if($reserva->estado === 'pendiente')
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="{{ route('mis-compras.edit', $reserva) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit me-1"></i> Editar
                                                        </a>
                                                        <form action="{{ route('mis-compras.cancelar', $reserva) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta reserva?');">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                <i class="fas fa-times me-1"></i> Cancelar
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

            <!-- Pestaña Aceptadas -->
            <div class="tab-pane fade" id="aceptadas" role="tabpanel" aria-labelledby="aceptadas-tab">
                @if($reservas_aceptadas->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-suitcase-rolling fa-4x mb-4"></i>
                        <h2>No tienes reservas confirmadas</h2>
                        <p class="lead text-muted">Tus reservas confirmadas aparecerán aquí. ¡Buen viaje!</p>
                    </div>
                @else
                    <div class="row">
                        @foreach($reservas_aceptadas as $reserva)
                            <div class="col-lg-12">
                                <div class="purchase-card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 text-center">
                                                @php
                                                    $iconClass = 'fa-question-circle';
                                                    if ($reserva->reservable_type === 'App\\Models\\Hospedaje') $iconClass = 'fa-bed';
                                                    if ($reserva->reservable_type === 'App\\Models\\Viaje') $iconClass = 'fa-plane';
                                                    if ($reserva->reservable_type === 'App\\Models\\Vehiculo') $iconClass = 'fa-car';
                                                    if ($reserva->tipo_reserva === 'paquete') $iconClass = 'fa-box';
                                                @endphp
                                                <i class="fas {{ $iconClass }} fa-3x purchase-icon"></i>
                                            </div>
                                            <div class="col-md-7">
                                                <h5 class="card-title mb-1">
                                                    @if($reserva->paquete)
                                                        {{ $reserva->paquete->nombre }}
                                                    @else
                                                        {{ $reserva->reservable->nombre ?? 'Reserva ' . $reserva->codigo_reserva }}
                                                    @endif
                                                </h5>
                                                <p class="card-text text-muted mb-2">
                                                    Código de reserva: <strong>{{ $reserva->codigo_reserva }}</strong>
                                                </p>
                                                <p class="card-text text-muted">
                                                    Fecha de compra: {{ $reserva->created_at->format('d/m/Y') }}
                                                </p>
                                            </div>
                                            <div class="col-md-3 text-md-end">
                                                <p class="price-highlight mb-2">
                                                    ARS {{ number_format($reserva->precio_total, 2, ',', '.') }}
                                                </p>
                                                <div>
                                                    @php
                                                        $estado = $reserva->estado;
                                                        $badgeClass = 'bg-success';
                                                    @endphp
                                                    <span class="badge status-badge {{ $badgeClass }}">{{ ucfirst($estado) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Pestaña Canceladas -->
            <div class="tab-pane fade" id="canceladas" role="tabpanel" aria-labelledby="canceladas-tab">
                @if($reservas_canceladas->isEmpty())
                    <div class="empty-state">
                        <i class="fas fa-history fa-4x mb-4"></i>
                        <h2>No tienes reservas canceladas</h2>
                        <p class="lead text-muted">Tu historial de reservas canceladas se mostrará aquí.</p>
                    </div>
                @else
                    <div class="row">
                        @foreach($reservas_canceladas as $reserva)
                            <div class="col-lg-12">
                                <div class="purchase-card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-2 text-center">
                                                @php
                                                    $iconClass = 'fa-question-circle';
                                                    if ($reserva->reservable_type === 'App\\Models\\Hospedaje') $iconClass = 'fa-bed';
                                                    if ($reserva->reservable_type === 'App\\Models\\Viaje') $iconClass = 'fa-plane';
                                                    if ($reserva->reservable_type === 'App\\Models\\Vehiculo') $iconClass = 'fa-car';
                                                    if ($reserva->tipo_reserva === 'paquete') $iconClass = 'fa-box';
                                                @endphp
                                                <i class="fas {{ $iconClass }} fa-3x purchase-icon"></i>
                                            </div>
                                            <div class="col-md-7">
                                                <h5 class="card-title mb-1">
                                                    @if($reserva->paquete)
                                                        {{ $reserva->paquete->nombre }}
                                                    @else
                                                        {{ $reserva->reservable->nombre ?? 'Reserva ' . $reserva->codigo_reserva }}
                                                    @endif
                                                </h5>
                                                <p class="card-text text-muted mb-2">
                                                    Código de reserva: <strong>{{ $reserva->codigo_reserva }}</strong>
                                                </p>
                                                <p class="card-text text-muted">
                                                    Fecha de compra: {{ $reserva->created_at->format('d/m/Y') }}
                                                </p>
                                            </div>
                                            <div class="col-md-3 text-md-end">
                                                <p class="price-highlight mb-2">
                                                    ARS {{ number_format($reserva->precio_total, 2, ',', '.') }}
                                                </p>
                                                <div>
                                                    @php
                                                        $estado = $reserva->estado;
                                                        $badgeClass = 'bg-danger';
                                                    @endphp
                                                    <span class="badge status-badge {{ $badgeClass }}">{{ ucfirst($estado) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
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
                        <li><a href="{{ route('results.index', ['tab' => 'viajes']) }}" class="text-light text-decoration-none">Vuelos</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'hospedajes']) }}" class="text-light text-decoration-none">Hoteles</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'paquetes']) }}" class="text-light text-decoration-none">Paquetes</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'vehiculos']) }}" class="text-light text-decoration-none">Autos</a></li>
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
        // Asegurarse de que el dropdown funcione
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>
</body>
</html>