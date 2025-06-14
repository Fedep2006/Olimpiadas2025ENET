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
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            height: 200px;
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
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-plane"></i> Vuelos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-bed"></i> Hoteles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-suitcase"></i> Paquetes</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-car"></i> Autos</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/login"><i class="fas fa-user"></i> Mi cuenta</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a></li>
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
                        <form action="/results" method="GET">
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
                                        <input type="text" name="origin" class="form-control border-0" placeholder="Ciudad de origen">
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
                                        <input type="text" name="destination" class="form-control border-0" placeholder="Ciudad de destino">
                                    </div>
                                </div>

                                <!-- Fecha Entrada -->
                                <div class="col-md-2 date-col">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="fas fa-calendar-alt me-2 text-primary"></i>ENTRADA
                                    </label>
                                    <div class="input-group input-elevated date-field-container">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="fas fa-calendar-check"></i>
                                        </span>
                                        <input type="date" name="checkin" class="form-control border-0">
                                    </div>
                                </div>

                                <!-- Fecha Salida -->
                                <div class="col-md-2 date-col">
                                    <label class="form-label fw-bold mb-2">
                                        <i class="fas fa-calendar-alt me-2 text-primary"></i>SALIDA
                                    </label>
                                    <div class="input-group input-elevated date-field-container">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="fas fa-calendar-times"></i>
                                        </span>
                                        <input type="date" name="checkout" class="form-control border-0">
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

    <!-- Hospedajes -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Hospedajes</h2>
            <div class="row">
            @foreach($hospedajes as $h)
            <div class="col-md-3 mb-4">
                <div class="destination-card">
                    <img 
                        src="data:image/jpeg;base64,{{ $h->imagen }}" 
                        class="w-100 h-100 object-fit-cover" 
                        alt="{{ $h->nombre }}"
                    >
                    <div class="destination-overlay">
                        <h5 class="mb-1">{{ $h->nombre }}</h5>
                        <p class="mb-0">Desde ${{ number_format($h->precio_noche, 2) }} / noche</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Viajes - MODIFICADO: Sin imágenes, solo cards con datos de BD -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Viajes</h2>
            <div class="row">
                @foreach($viajes as $viaje)
                <div class="col-md-3 mb-4">
                    <div class="travel-card">
                        <i class="fas fa-map-marked-alt travel-icon"></i>
                        <h5 class="mb-1">{{ $viaje->nombre }}</h5>
                        <p class="price mb-0">Desde ${{ number_format($viaje->precio, 2) }}</p>
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

    <!-- Vehículos -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Vehículos</h2>
            <div class="row">
            @foreach($vehiculos as $v)
            <div class="col-md-3 mb-4">
                <div class="destination-card">
                    <img 
                        src="data:image/jpeg;base64,{{ is_array($v->imagenes) ? $v->imagenes[0] : $v->imagenes }}" 
                        class="w-100 h-100 object-fit-cover" 
                        alt="{{ $v->marca }} {{ $v->modelo }}"
                    >
                    <div class="destination-overlay">
                        <h5 class="mb-1">{{ $v->marca }} {{ $v->modelo }}</h5>
                        <p class="mb-0">Desde ${{ number_format($v->precio_por_dia, 2) }} / día</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

    <!-- Paquetes (Solo Visual) -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Paquetes</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="destination-card">
                        <div class="visual-badge">Esto es visual</div>
                        <img 
                            src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop" 
                            class="w-100 h-100 object-fit-cover" 
                            alt="Paquete París"
                        >
                        <div class="destination-overlay">
                            <h5 class="mb-1">Paquete París</h5>
                            <p class="mb-0">Desde $1,299</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="destination-card">
                        <div class="visual-badge">Esto es visual</div>
                        <img 
                            src="https://images.unsplash.com/photo-1539650116574-75c0c6d73f6e?w=400&h=300&fit=crop" 
                            class="w-100 h-100 object-fit-cover" 
                            alt="Paquete Roma"
                        >
                        <div class="destination-overlay">
                            <h5 class="mb-1">Paquete Roma</h5>
                            <p class="mb-0">Desde $999</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="destination-card">
                        <div class="visual-badge">Esto es visual</div>
                        <img 
                            src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=400&h=300&fit=crop" 
                            class="w-100 h-100 object-fit-cover" 
                            alt="Paquete Londres"
                        >
                        <div class="destination-overlay">
                            <h5 class="mb-1">Paquete Londres</h5>
                            <p class="mb-0">Desde $1,199</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="destination-card">
                        <div class="visual-badge">Esto es visual</div>
                        <img 
                            src="https://images.unsplash.com/photo-1543832923-44667a44c804?w=400&h=300&fit=crop" 
                            class="w-100 h-100 object-fit-cover" 
                            alt="Paquete Barcelona"
                        >
                        <div class="destination-overlay">
                            <h5 class="mb-1">Paquete Barcelona</h5>
                            <p class="mb-0">Desde $899</p>
                        </div>
                    </div>
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
