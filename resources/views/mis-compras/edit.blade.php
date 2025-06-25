<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva - Frategar</title>
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

        /* Estilos específicos para Editar Reserva */
        .page-title {
            color: var(--despegar-blue);
            font-weight: bold;
            margin-bottom: 2rem;
        }

        .edit-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .edit-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .edit-card .card-header {
            background: linear-gradient(135deg, var(--despegar-blue), #0052a3);
            border-radius: 15px 15px 0 0;
            border: none;
        }

        .edit-card .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
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

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: bold;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268, #6c757d);
            transform: translateY(-1px);
        }

        .alert {
            border-radius: 15px;
            border: none;
        }

        .reserva-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid var(--despegar-blue);
        }

        .reserva-info h4 {
            color: var(--despegar-blue);
            margin-bottom: 0.5rem;
        }

        .reserva-info p {
            color: #6c757d;
            margin-bottom: 0;
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

    <!-- Contenido Principal - Editar Reserva -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <h1 class="page-title text-center">Editar Reserva</h1>

                @if (session('success'))
                    <div class="alert alert-success shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="edit-card">
                    <div class="card-header text-white">
                        <h1 class="h4 mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Reserva: {{ $reserva->codigo_reserva }}
                        </h1>
                </div>
                <div class="card-body">
                        <!-- Información de la reserva -->
                        <div class="reserva-info">
                            <h4>{{ $reservable->nombre }}</h4>
                            <p class="text-muted">Modifica los detalles de tu reserva a continuación.</p>
                        </div>

                        <form action="{{ route('mis-compras.update', $reserva) }}" method="POST">
                            @csrf
                            @method('PUT')

                        <!-- Campos del formulario -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                    <label for="fecha_inicio" class="form-label">
                                        <i class="fas fa-calendar-alt me-1"></i> Fecha de Inicio
                                    </label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                                           value="{{ old('fecha_inicio', $reserva->fecha_inicio->format('Y-m-d')) }}" required>
                                    @error('fecha_inicio')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                            </div>
                                
                            @if(in_array($reserva->reservable_type, ['App\\Models\\Viaje', 'App\\Models\\Hospedaje']))
                            <div class="col-md-6 mb-3">
                                    <label for="fecha_fin" class="form-label">
                                        <i class="fas fa-calendar-check me-1"></i> Fecha de Fin
                                    </label>
                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" 
                                           value="{{ old('fecha_fin', $reserva->fecha_fin ? $reserva->fecha_fin->format('Y-m-d') : '') }}" required>
                                    @error('fecha_fin')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                            </div>
                            @endif
                                
                            <div class="col-md-6 mb-3">
                                    <label for="cantidad_personas" class="form-label">
                                        <i class="fas fa-users me-1"></i> Cantidad de Personas
                                    </label>
                                    <input type="number" class="form-control" id="cantidad_personas" name="cantidad_personas" 
                                           value="{{ old('cantidad_personas', 1) }}" min="1" required>
                                    @error('cantidad_personas')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <a href="{{ route('mis-compras') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Actualizar Reserva
                                </button>
                        </div>
                    </form>
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
