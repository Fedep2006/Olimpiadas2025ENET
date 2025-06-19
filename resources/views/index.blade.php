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

        /* Hero con video de fondo mejorado */
        .hero-section {
            position: relative;
            color: white;
            padding: 100px 0;
            background: none;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .hero-video-bg {
            position: absolute;
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }
        
        .hero-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        
        .hero-section .container {
            position: relative;
            z-index: 2;
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
                        <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <video class="hero-video-bg" src="{{ asset('img/fondo.mp4') }}" autoplay loop muted playsinline></video>
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
                                <div class="col-md-2">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="fas fa-bed me-2 text-primary"></i>HABITACIONES
                                    </label>
                                    <div class="input-group input-elevated">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <input type="number" name="guests" min="1" class="form-control border-0" value="1">
                                    </div>
                                </div>
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
                    <div class="destination-card position-relative overflow-hidden h-100">
                        @php
                            $img = is_array($paquete->imagenes) ? ($paquete->imagenes[0] ?? null) : (is_string($paquete->imagenes) ? $paquete->imagenes : null);
                        @endphp
                        @if($img)
                        <img src="{{ $img }}" alt="{{ $paquete->nombre }}" style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;z-index:1;">
                        @endif
                        <div class="hotel-overlay" style="position:absolute;top:0;left:0;width:100%;height:100%;background:linear-gradient(transparent 40%,rgba(0,0,0,0.85) 100%);z-index:2;transition:opacity 0.4s;"></div>
                        <div class="destination-overlay hotel-overlay-content d-flex flex-column justify-content-end align-items-start p-3" style="position:relative;z-index:3;transition:opacity 0.4s;height:100%;">
                            <h5 class="mb-1">{{ $paquete->nombre }}</h5>
                            <p class="mb-1">{{ $paquete->descripcion }}</p>
                            <p class="mb-0 fw-bold">${{ number_format($paquete->precio_total, 2) }}</p>
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
