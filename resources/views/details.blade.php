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
                            <a href="{{ route('carrito') }}" class="btn btn-link p-0 m-0 position-relative" style="font-size:1.2rem;" title="Carrito">
                                <i class="fas fa-shopping-cart"></i>
                                @php
                                    $carrito = session('carrito', []);
                                    $totalItems = array_sum(array_column($carrito, 'cantidad'));
                                @endphp
                                @if($totalItems > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.7rem;">
                                        {{ $totalItems }}
                                    </span>
                                @endif
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
                @endif
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
            </div>
            @else
            <div class="travel-card p-4 mb-4 shadow-lg position-relative">
                <div class="travel-icon mb-3">
                    @if($type === 'paquete')
                        <i class="fas fa-suitcase fa-3x"></i>
                    @elseif($type === 'viaje')
                        <i class="fas fa-bus fa-3x"></i>
                    @elseif($type === 'vehiculo')
                        <i class="fas fa-car fa-3x"></i>
                    @endif
                </div>
                <h2 class="mb-3 text-primary">
                    @if($type === 'paquete')
                        {{ $item->nombre }}
                    @elseif($type === 'viaje')
                        {{ $item->nombre }}
                    @elseif($type === 'vehiculo')
                        {{ $item->nombre ?? ($item->marca . ' ' . $item->modelo) }}
                    @endif
                </h2>
                
                @if($type === 'paquete')
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <p><strong>Número de paquete:</strong> {{ $item->numero_paquete }}</p>
                            <p><strong>Duración:</strong> {{ $item->duracion }}</p>
                            <p><strong>Ubicación:</strong> {{ $item->ubicacion }}</p>
                            <p><strong>Activo:</strong> <span class="badge {{ $item->activo ? 'bg-success' : 'bg-danger' }}">{{ $item->activo ? 'Sí' : 'No' }}</span></p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p><strong>Cupo mínimo:</strong> {{ $item->cupo_minimo }}</p>
                            <p><strong>Cupo máximo:</strong> {{ $item->cupo_maximo ?? 'No especificado' }}</p>
                            <p><strong>Precio total:</strong> <span class="price">${{ number_format($item->precio_total, 2) }}</span></p>
                        </div>
                    </div>
                    @if($item->descripcion)
                        <hr>
                        <p class="mb-2"><strong>Descripción:</strong></p>
                        <p>{{ $item->descripcion }}</p>
                    @endif
                @elseif($type === 'viaje')
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <p><strong>Número de viaje:</strong> {{ $item->numero_viaje }}</p>
                            <p><strong>Tipo:</strong> {{ ucfirst($item->tipo) }}</p>
                            <p><strong>Origen:</strong> {{ $item->origen }}</p>
                            <p><strong>Destino:</strong> {{ $item->destino }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p><strong>Fecha de salida:</strong> {{ optional($item->fecha_salida)->format('d/m/Y H:i') }}</p>
                            <p><strong>Fecha de llegada:</strong> {{ optional($item->fecha_llegada)->format('d/m/Y H:i') }}</p>
                            <p><strong>Capacidad total:</strong> {{ $item->capacidad_total }}</p>
                            <p><strong>Asientos disponibles:</strong> {{ $item->asientos_disponibles }}</p>
                            <p><strong>Precio base:</strong> <span class="price">${{ number_format($item->precio_base, 2) }}</span></p>
                        </div>
                    </div>
                    @if($item->descripcion)
                        <hr>
                        <p class="mb-2"><strong>Descripción:</strong></p>
                        <p>{{ $item->descripcion }}</p>
                    @endif
                @elseif($type === 'vehiculo')
                     <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <p><strong>Tipo:</strong> {{ ucfirst($item->tipo) }}</p>
                            <p><strong>Marca:</strong> {{ $item->marca }}</p>
                            <p><strong>Modelo:</strong> {{ $item->modelo }}</p>
                            <p><strong>Año:</strong> {{ $item->antiguedad }}</p>
                            <p><strong>Patente:</strong> {{ $item->patente }}</p>
                            <p><strong>Color:</strong> {{ $item->color }}</p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p><strong>Ubicación:</strong> {{ $item->ubicacion }}</p>
                            <p><strong>Capacidad de pasajeros:</strong> {{ $item->capacidad_pasajeros }}</p>
                            <p><strong>Vehículos disponibles:</strong> {{ $item->vehiculos_disponibles }}</p>
                            <p><strong>Disponible:</strong> <span class="badge {{ $item->disponible ? 'bg-success' : 'bg-danger' }}">{{ $item->disponible ? 'Sí' : 'No' }}</span></p>
                            <p><strong>Precio por día:</strong> <span class="price">${{ number_format($item->precio_por_dia, 2) }}</span></p>
                        </div>
                    </div>
                    @if($item->descripcion)
                        <hr>
                        <p class="mb-2"><strong>Descripción:</strong></p>
                        <p>{{ $item->descripcion }}</p>
                    @endif
                @endif
                
                <div class="d-flex flex-column flex-md-row gap-3 mt-4 justify-content-center">
                    @if($type === 'paquete')
                        <form method="POST" action="{{ route('carrito.paquete.add', $item->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning px-4"><i class="fas fa-cart-plus me-2"></i>Añadir al carrito</button>
                        </form>
                    @elseif($type === 'viaje')
                        <form method="POST" action="{{ route('carrito.viaje.add', $item->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning px-4"><i class="fas fa-cart-plus me-2"></i>Añadir al carrito</button>
                        </form>
                    @elseif($type === 'vehiculo')
                        <form method="POST" action="{{ route('carrito.vehiculo.add', $item->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning px-4"><i class="fas fa-cart-plus me-2"></i>Añadir al carrito</button>
                        </form>
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
