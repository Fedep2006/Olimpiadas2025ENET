<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frategar - Viajes, Vuelos, Hoteles y Paquetes</title>
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

        /* Hero con imagen de fondo */
        .hero-section {
            position: relative;
            color: white;
            padding: 60px 0;
            background: none; /* Quitar imagen de fondo */
            overflow: hidden;
        }
        .hero-video-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
            z-index: 0;
        }
        .hero-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .search-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
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

        .btn-search {
            background-color: var(--despegar-orange);
            border: none;
            border-radius: 25px;
            padding: 12px 40px;
            font-weight: bold;
            color: white;
        }

        .btn-search:hover {
            background-color: #e55a00;
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

        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
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
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-ship"></i> Cruceros</a></li>
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
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3">¡Viajá como querés!</h1>
                    <p class="lead mb-4">Encontrá vuelos, hoteles y paquetes al mejor precio</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="search-card">
                        <!-- Tabs -->
                        <ul class="nav nav-pills tab-pills mb-4" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="pill" href="#vuelos">
                                    <i class="fas fa-plane me-2"></i>Vuelos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#hoteles">
                                    <i class="fas fa-bed me-2"></i>Hoteles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#paquetes">
                                    <i class="fas fa-suitcase me-2"></i>Paquetes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill" href="#autos">
                                    <i class="fas fa-car me-2"></i>Autos
                                </a>
                            </li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Vuelos Tab -->
                            <div class="tab-pane fade show active" id="vuelos">
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Origen</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                                                <input type="text" class="form-control" placeholder="¿Desde dónde salís?" value="Buenos Aires (BUE)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Destino</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                                                <input type="text" class="form-control" placeholder="¿A dónde vas?">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Ida</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Vuelta</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Pasajeros</label>
                                            <select class="form-select">
                                                <option>1 adulto</option>
                                                <option>2 adultos</option>
                                                <option>3 adultos</option>
                                                <option>4 adultos</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Clase</label>
                                            <select class="form-select">
                                                <option>Económica</option>
                                                <option>Premium</option>
                                                <option>Business</option>
                                                <option>Primera</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-search btn-lg">
                                            <i class="fas fa-search me-2"></i>Buscar vuelos
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- Hoteles Tab -->
                            <div class="tab-pane fade" id="hoteles">
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Destino</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                <input type="text" class="form-control" placeholder="¿A dónde vas?">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Huéspedes</label>
                                            <select class="form-select">
                                                <option>2 huéspedes, 1 habitación</option>
                                                <option>3 huéspedes, 1 habitación</option>
                                                <option>4 huéspedes, 2 habitaciones</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Check-in</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Check-out</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-search btn-lg">
                                            <i class="fas fa-search me-2"></i>Buscar hoteles
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- Paquetes Tab -->
                            <div class="tab-pane fade" id="paquetes">
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Origen</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                                                <input type="text" class="form-control" placeholder="¿Desde dónde salís?" value="Buenos Aires (BUE)">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Destino</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-suitcase"></i></span>
                                                <input type="text" class="form-control" placeholder="¿A dónde vas?">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Salida</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Regreso</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Pasajeros</label>
                                            <select class="form-select">
                                                <option>2 pasajeros</option>
                                                <option>3 pasajeros</option>
                                                <option>4 pasajeros</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-search btn-lg">
                                            <i class="fas fa-search me-2"></i>Buscar paquetes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- Autos Tab -->
                            <div class="tab-pane fade" id="autos">
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Lugar de retiro</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                <input type="text" class="form-control" placeholder="Ciudad o aeropuerto">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Lugar de devolución</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                <input type="text" class="form-control" placeholder="Ciudad o aeropuerto">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Fecha de retiro</label>
                                            <input type="datetime-local" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Fecha de devolución</label>
                                            <input type="datetime-local" class="form-control">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-search btn-lg">
                                            <i class="fas fa-search me-2"></i>Buscar autos
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ofertas Destacadas -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Ofertas destacadas</h2>
                    <p class="text-muted">Los mejores precios para tu próximo viaje</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <a  href="/detalles"  style="text-decoration: none; color: inherit;">
                    <div class="card offer-card h-100">
                        <img src="/placeholder.svg?height=200&width=400" class="card-img-top" alt="Miami">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title">Miami</h5>
                                <span class="price-tag">$899</span>
                            </div>
                            <p class="card-text text-muted">Vuelo + Hotel por 7 noches</p>
                            <p class="card-text"><small class="text-success">¡Oferta por tiempo limitado!</small></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                       <a  href="/detalles  style="text-decoration: none; color: inherit;"">
                    <div class="card offer-card h-100">
                        <img src="/placeholder.svg?height=200&width=400" class="card-img-top" alt="Cancún">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title">Cancún</h5>
                                <span class="price-tag">$750</span>
                            </div>
                            <p class="card-text text-muted">Paquete todo incluido</p>
                            <p class="card-text"><small class="text-success">¡Últimas plazas disponibles!</small></p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                      <a  href="/detalles" style="text-decoration: none; color: inherit;">
                    <div class="card offer-card h-100">
                        <img src="/placeholder.svg?height=200&width=400" class="card-img-top" alt="Europa">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title">Europa</h5>
                                <span class="price-tag">$1,299</span>
                            </div>
                            <p class="card-text text-muted">Tour por 3 ciudades</p>
                            <p class="card-text"><small class="text-success">¡Incluye traslados!</small></p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinos Populares -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Destinos populares</h2>
                    <p class="text-muted">Los lugares más elegidos por nuestros viajeros</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="destination-card">
                        <img src="/placeholder.svg?height=200&width=300" class="w-100 h-100 object-fit-cover" alt="París">
                        <div class="destination-overlay">
                            <h5 class="mb-1">París</h5>
                            <p class="mb-0">Desde $1,200</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="destination-card">
                        <img src="/placeholder.svg?height=200&width=300" class="w-100 h-100 object-fit-cover" alt="Nueva York">
                        <div class="destination-overlay">
                            <h5 class="mb-1">Nueva York</h5>
                            <p class="mb-0">Desde $950</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="destination-card">
                        <img src="/placeholder.svg?height=200&width=300" class="w-100 h-100 object-fit-cover" alt="Tokio">
                        <div class="destination-overlay">
                            <h5 class="mb-1">Tokio</h5>
                            <p class="mb-0">Desde $1,800</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="destination-card">
                        <img src="/placeholder.svg?height=200&width=300" class="w-100 h-100 object-fit-cover" alt="Londres">
                        <div class="destination-overlay">
                            <h5 class="mb-1">Londres</h5>
                            <p class="mb-0">Desde $1,100</p>
                        </div>
                    </div>
                </div>
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
