<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles - Frategar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <div class="d-flex align-items-center gap-4">
                            <a href="{{ route('carrito') }}" class="btn btn-link p-0 m-0" style="font-size:1.2rem;" title="Carrito">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                            <a class="nav-link d-flex align-items-center dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                        </div>
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
                    <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if($type === 'hospedaje')
            <div class="travel-card p-4 mb-4 shadow-lg position-relative">
                <span class="position-absolute top-0 end-0 badge bg-info mt-3 me-3" style="font-size:1rem;">ID: {{ $item->id }}</span>
                <div class="travel-icon mb-3">
                    <i class="fas fa-bed fa-3x"></i>
                </div>
                <h2 class="mb-3 text-primary">{{ $item->nombre }}</h2>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <p><strong>Tipo:</strong> {{ $item->tipo }}</p>
                        <p><strong>Habitación:</strong> {{ $item->habitacion }}</p>
                        <p><strong>Habitaciones disponibles:</strong> {{ $item->habitaciones_disponibles }}</p>
                        <p><strong>Capacidad personas:</strong> {{ $item->capacidad_personas }}</p>
                        <p><strong>Precio por noche:</strong> <span class="price">${{ number_format($item->precio_por_noche, 2) }}</span></p>
                        <p><strong>Estrellas:</strong> {{ $item->estrellas }}</p>
                        <p><strong>Calificación:</strong> {{ $item->calificacion }}</p>
                        <p><strong>Activo:</strong> <span class="badge {{ $item->activo ? 'bg-success' : 'bg-danger' }}">{{ $item->activo ? 'Sí' : 'No' }}</span></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <p><strong>País:</strong> {{ $item->pais }}</p>
                        <p><strong>Ciudad:</strong> {{ $item->ciudad }}</p>
                        <p><strong>Ubicación:</strong> {{ $item->ubicacion }}</p>
                        <p><strong>Check-in:</strong> {{ $item->check_in }}</p>
                        <p><strong>Check-out:</strong> {{ $item->check_out }}</p>
                        <p><strong>Teléfono:</strong> {{ $item->telefono }}</p>
                        <p><strong>Email:</strong> <a href="mailto:{{ $item->email }}">{{ $item->email }}</a></p>
                        <p><strong>Sitio web:</strong> <a href="{{ $item->sitio_web }}" target="_blank">{{ $item->sitio_web }}</a></p>
                    </div>
                </div>
                <hr>
                <p class="mb-2"><strong>Descripción:</strong></p>
                <p>{{ $item->descripcion }}</p>
                @if($item->condiciones)
                    <hr>
                    <p class="mb-2"><strong>Condiciones:</strong></p>
                    <p>{{ $item->condiciones }}</p>
                                <div class="d-flex flex-column flex-md-row gap-3 mt-4 justify-content-center">
                    <form method="POST" action="{{ route('carrito.hospedaje.add', $item->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-warning px-4"><i class="fas fa-cart-plus me-2"></i>Añadir al carrito</button>
                    </form>
                    <form method="POST" action="{{ route('reservar.hospedaje', $item->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary px-4"><i class="fas fa-calendar-check me-2"></i>Reservar ahora</button>
                    </form>
                </div>
            @endif
            </div>
            @else
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        @if($type === 'paquete')
                            <i class="fas fa-suitcase"></i> Paquete: {{ $item->nombre }}
                        @elseif($type === 'viaje')
                            <i class="fas fa-bus"></i> Viaje: {{ $item->nombre }}
                        @elseif($type === 'vehiculo')
                            <i class="fas fa-car"></i> Vehículo: {{ $item->nombre ?? $item->marca }}
                        @endif
                    </h3>
                </div>
                <div class="card-body">
                    @if($type === 'paquete')
                        <p><strong>Descripción:</strong> {{ $item->descripcion }}</p>
                        <p><strong>Precio total:</strong> ${{ number_format($item->precio_total, 2) }}</p>
                    @elseif($type === 'viaje')
                        <p><strong>Origen:</strong> {{ $item->origen }}</p>
                        <p><strong>Destino:</strong> {{ $item->destino }}</p>
                        <p><strong>Fecha de salida:</strong> {{ optional($item->fecha_salida)->format('d/m/Y H:i') }}</p>
                        <p><strong>Precio base:</strong> ${{ number_format($item->precio_base, 2) }}</p>
                    @elseif($type === 'vehiculo')
                        <p><strong>Marca:</strong> {{ $item->marca }}</p>
                        <p><strong>Modelo:</strong> {{ $item->modelo }}</p>
                        <p><strong>Precio por día:</strong> ${{ number_format($item->precio_por_dia, 2) }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
</body>
</html>
