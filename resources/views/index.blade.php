<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frategar - Viajes, Vuelos, Hoteles y Paquetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .destination-card .hotel-overlay {
            opacity: 1;
        }
        .destination-card .hotel-overlay-content {
            opacity: 1;
        }
        .destination-card:hover .hotel-overlay,
        .destination-card:hover .hotel-overlay-content {
            opacity: 0;
        }
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

        /* Hero con fondo gradiente mejorado */
        .hero-section {
            position: relative;
            color: white;
            padding: 100px 0;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #2563eb 50%, #3b82f6 75%, #60a5fa 100%);
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        /* Elementos decorativos para el fondo */
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 102, 0, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 60%, rgba(59, 130, 246, 0.15) 0%, transparent 50%);
            z-index: 1;
        }
        
        .hero-section::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 2;
        }
        
        .hero-section .container {
            position: relative;
            z-index: 3;
            width: 100%;
        }

        /* Buscador mejorado */
        .search-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.2);
            padding: 40px;
            margin-top: 0;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        
        .search-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }

        .input-group.input-elevated {
            border: none;
            border-radius: 15px;
            padding: 0.5rem;
            min-height: 70px;
            background-color: #f8f9fa;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .input-group.input-elevated:focus-within {
            box-shadow: 0 5px 20px rgba(0,102,204,0.15);
            background-color: white;
        }

        .input-group .form-control {
            font-size: 1.1rem;
            padding: 0.75rem 1rem;
            border: none;
            background: transparent;
        }
        
        /* Mejora específica para los campos de fecha */
        input[type="date"].form-control {
            font-size: 1rem;
            min-width: 100%;
            padding: 0.75rem 0.5rem;
            height: auto;
            cursor: pointer;
            color: #495057;
            font-weight: 500;
        }
        
        /* Ajuste para el contenedor de fechas */
        .date-field-container {
            min-width: 100%;
        }
        
        .input-group .form-control:focus {
            box-shadow: none;
        }
        
        .input-group .input-group-text {
            color: var(--despegar-blue);
        }
        
        .form-label {
            color: #495057;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }

        .btn-search {
            background: linear-gradient(135deg, var(--despegar-orange), #ff8533);
            border: none;
            border-radius: 50px;
            padding: 15px 50px;
            font-weight: bold;
            color: white;
            box-shadow: 0 5px 15px rgba(255,102,0,0.3);
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background: linear-gradient(135deg, #ff8533, var(--despegar-orange));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255,102,0,0.4);
        }

        .tab-pills .nav-link {
            border-radius: 25px;
            margin-right: 10px;
            padding: 10px 20px;
            border: 2px solid transparent;
            color: var(--despegar-blue);
        }

        .tab-pills .nav-link.active {
            background-color: var(--despegar-blue);
            color: white;
        }

        .offer-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .offer-card:hover {
            transform: translateY(-5px);
        }

        .price-tag {
            background-color: var(--despegar-orange);
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
        }

        .destination-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px 20px;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .destination-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-color: var(--despegar-blue);
        }

        .destination-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            padding: 20px;
        }

        /* Nuevo estilo para las cards de viajes sin imagen */
        .travel-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px 20px;
            border: 2px solid transparent;
        }

        .travel-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-color: var(--despegar-blue);
        }

        .travel-card h5 {
            color: var(--despegar-blue);
            font-weight: bold;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .travel-card .price {
            color: var(--despegar-orange);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .travel-card .travel-icon {
            color: var(--despegar-blue);
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
        }
        
        /* Estilos para los títulos de sección */
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--despegar-blue);
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--despegar-orange);
            border-radius: 2px;
        }

        /* Estilo para el badge visual */
        .visual-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 102, 0, 0.9);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: bold;
            z-index: 3;
        }
        
        /* Ajuste responsivo para fechas en móviles */
        @media (max-width: 768px) {
            .date-col {
                width: 50%;
            }
            
            .section-title {
                font-size: 2rem;
            }
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="search-card">
                        <form action="/results" method="GET" autocomplete="off">
                            <div class="row g-4 align-items-center">
                                <!-- Origen -->
                                <div class="col-md-3">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="fas fa-dot-circle me-2 text-primary"></i>ORIGEN
                                    </label>
                                    <div class="input-group input-elevated">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="fas fa-plane-departure"></i>
                                        </span>
                                        <input type="text" name="origin" class="form-control border-0" placeholder="Ciudad de origen" id="input-origin" autocomplete="off" list="list-origin">
<datalist id="list-origin"></datalist>
                                    </div>
                                </div>

                                <!-- Destino -->
                                <div class="col-md-3">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>DESTINO
                                    </label>
                                    <div class="input-group input-elevated">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="fas fa-plane-arrival"></i>
                                        </span>
                                        <input type="text" name="destination" class="form-control border-0" placeholder="Ciudad de destino" id="input-destination" autocomplete="off" list="list-destination">
<datalist id="list-destination"></datalist>
                                    </div>
                                </div>

                                <!-- Fecha Ida -->
                                <div class="col-md-2 date-col">
                                        <label class="form-label fw-bold mb-2">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>IDA
                                        </label>
                                    <div class="input-group input-elevated date-field-container">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="fas fa-calendar-check"></i>
                                        </span>
                                            <input type="date" name="checkin" class="form-control border-0" placeholder="Fecha de ida">
                                    </div>
                                </div>

                                <!-- Fecha Vuelta -->
                                <div class="col-md-2 date-col">
                                        <label class="form-label fw-bold mb-2">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>VUELTA
                                        </label>
                                    <div class="input-group input-elevated date-field-container">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="fas fa-calendar-times"></i>
                                        </span>
                                            <input type="date" name="checkout" class="form-control border-0" placeholder="Fecha de vuelta">
                                    </div>
                                </div>

                                <!-- Habitaciones -->
                                
                            </div>

                            <!-- Botón Buscar -->
                            <div class="text-center mt-4">
                                <button class="btn btn-search rounded-pill px-5 py-3 fs-5">
                                    <i class="fas fa-search me-2"></i>Buscar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Paquetes (desde base de datos) -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Paquetes</h2>
            <div class="row">
                @foreach($paquetes as $paquete)
                <div class="col-md-4 mb-4">
                    <div class="travel-card h-100 position-relative">
                        <a href="{{ route('details.show', ['tipo' => 'paquete', 'id' => $paquete->id]) }}" class="text-decoration-none text-dark stretched-link">
                            <div class="travel-icon">
                                <i class="fas fa-suitcase"></i>
                            </div>
                            <h5>{{ $paquete->nombre }}</h5>
                            <p class="mb-3">{{ $paquete->descripcion }}</p>
                            <p class="price">${{ number_format($paquete->precio_total, 2) }}</p>
                        </a>
                        <div class="mt-3" style="position: relative; z-index: 1;">
                            <form method="POST" action="{{ route('carrito.paquete.add', $paquete->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-cart-plus me-1"></i>Añadir al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

        <!-- Viajes individuales (desde base de datos) -->
        <section class="py-5">
        <div class="container">
            <h2 class="section-title">Viajes</h2>
            <div class="row">
                @foreach($viajes as $viaje)
                <div class="col-md-4 mb-4">
                    <div class="travel-card h-100 position-relative">
                        <a href="{{ route('viajes.show', $viaje->id) }}" class="text-decoration-none text-dark stretched-link">
                            <div class="travel-icon">
                                <i class="fas fa-bus"></i>
                            </div>
                            <h5>{{ $viaje->nombre }}</h5>
                            <p class="mb-3">{{ $viaje->origen }} → {{ $viaje->destino }}</p>
                            <p class="price">${{ number_format($viaje->precio_base ?? 0, 2) }}</p>
                            <span class="badge bg-info">Salida: {{ optional($viaje->fecha_salida)->format('d/m/Y H:i') }}</span>
                        </a>
                        <div class="mt-3" style="position: relative; z-index: 1;">
                            <form method="POST" action="{{ route('carrito.viaje.add', $viaje->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-cart-plus me-1"></i>Añadir al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Hospedajes (desde base de datos) -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Hospedajes</h2>
            <div class="row">
                @foreach($hospedajes as $hospedaje)
                <div class="col-md-4 mb-4">
                    <div class="travel-card h-100 position-relative">
                        <a href="{{ url('/details/hospedaje/'.$hospedaje->id) }}" class="text-decoration-none text-dark stretched-link">
                            <div class="travel-icon">
                                <i class="fas fa-bed"></i>
                            </div>
                            <h5>{{ $hospedaje->nombre }}</h5>
                            <p class="mb-3">{{ $hospedaje->descripcion }}</p>
                            <p class="price">${{ number_format($hospedaje->precio_por_noche ?? 0, 2) }} / noche</p>
                            <span class="badge bg-info">{{ $hospedaje->ciudad?->nombre ?? '' }}</span>
                        </a>
                        <div class="mt-3" style="position: relative; z-index: 1;">
                            <form method="POST" action="{{ route('carrito.hospedaje.add', $hospedaje->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-cart-plus me-1"></i>Añadir al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Vehiculos (desde base de datos) -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Vehículos</h2>
            <div class="row">
                @foreach($vehiculos as $vehiculo)
                <div class="col-md-4 mb-4">
                    <div class="travel-card h-100 position-relative">
                        <a href="{{ url('/details/vehiculo/'.$vehiculo->id) }}" class="text-decoration-none text-dark stretched-link">
                            <div class="travel-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <h5>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h5>
                            <p class="mb-3">{{ $vehiculo->tipo }}</p>
                            <p class="price">${{ number_format($vehiculo->precio_por_dia ?? 0, 2) }} / día</p>
                            <span class="badge bg-info">{{ $vehiculo->ubicacion?->nombre ?? '' }}</span>
                        </a>
                        <div class="mt-3" style="position: relative; z-index: 1;">
                            <form method="POST" action="{{ route('carrito.vehiculo.add', $vehiculo->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-cart-plus me-1"></i>Añadir al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-shield-alt fa-3x text-primary"></i>
                    </div>
                    <h5>Compra protegida</h5>
                    <p class="text-muted">Tu dinero está protegido con nosotros</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-headset fa-3x text-primary"></i>
                    </div>
                    <h5>Atención 24/7</h5>
                    <p class="text-muted">Te ayudamos cuando lo necesites</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-percent fa-3x text-primary"></i>
                    </div>
                    <h5>Mejores precios</h5>
                    <p class="text-muted">Garantizamos el mejor precio</p>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-car-side fa-3x text-primary"></i>
                    </div>
                    <h5>Autos y más</h5>
                    <p class="text-muted">Alquiler de autos y otros servicios</p>
                </div>
            </div>
        </div>
    </section>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Autocompletado de ciudades para origen y destino
fetch('/api/ciudades')
  .then(res => res.json())
  .then(ciudades => {
    const listOrigin = document.getElementById('list-origin');
    const listDestination = document.getElementById('list-destination');
    listOrigin.innerHTML = ciudades.map(c => `<option value="${c}">`).join('');
    listDestination.innerHTML = ciudades.map(c => `<option value="${c}">`).join('');
  });
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