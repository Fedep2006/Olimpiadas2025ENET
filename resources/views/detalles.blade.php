<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Vuelo - Frategar</title>
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
        
        .breadcrumb-section {
            background-color: #f8f9fa;
            padding: 15px 0;
        }
        
        .breadcrumb-item a {
            color: var(--despegar-blue);
            text-decoration: none;
        }
        
        .breadcrumb-item a:hover {
            color: var(--despegar-orange);
        }
        
        .detail-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .flight-header {
            background: linear-gradient(135deg, var(--despegar-blue) 0%, #004499 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }
        
        .price-highlight {
            background-color: var(--despegar-orange);
            color: white;
            padding: 15px 25px;
            border-radius: 15px;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
        
        .btn-book {
            background-color: var(--despegar-orange);
            border: none;
            border-radius: 10px;
            padding: 15px 30px;
            font-weight: bold;
            color: white;
            font-size: 1.1rem;
            width: 100%;
        }
        
        .btn-book:hover {
            background-color: #e55a00;
            color: white;
            transform: translateY(-2px);
        }
        
        .flight-route {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 20px 0;
        }
        
        .airport-info {
            text-align: center;
            flex: 1;
        }
        
        .airport-code {
            font-size: 2rem;
            font-weight: bold;
            color: white;
        }
        
        .airport-name {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .flight-line {
            flex: 2;
            position: relative;
            margin: 0 20px;
        }
        
        .flight-line::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: white;
            transform: translateY(-50%);
        }
        
        .flight-duration {
            background-color: rgba(255,255,255,0.2);
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.9rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .airline-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .airline-logo {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            margin-right: 15px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .detail-section {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        
        .detail-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .detail-title {
            color: var(--despegar-blue);
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 500;
            color: #6c757d;
        }
        
        .info-value {
            font-weight: bold;
            color: #333;
        }
        
        .amenity-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .amenity-item i {
            color: var(--despegar-blue);
            margin-right: 10px;
            width: 20px;
        }
        
        .baggage-info {
            background-color: var(--despegar-light-blue);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .alert-info {
            background-color: #e3f2fd;
            border: 1px solid #2196f3;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
        }
        
        .sticky-booking {
            position: sticky;
            top: 20px;
        }
        
        .rating-stars {
            color: #ffc107;
            margin-right: 10px;
        }
        
        .tab-content-details {
            padding: 20px 0;
        }
        
        .nav-tabs-custom .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6c757d;
            font-weight: 500;
        }
        
        .nav-tabs-custom .nav-link.active {
            border-bottom-color: var(--despegar-blue);
            color: var(--despegar-blue);
            background: none;
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
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-ship"></i> Cruceros</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.html"><i class="fas fa-user"></i> Mi cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Vuelos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buenos Aires - Miami</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-4">
        <div class="row">
            <!-- Flight Details -->
            <div class="col-lg-8">
                <!-- Flight Header -->
                <div class="flight-header">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h2 class="mb-1">Buenos Aires - Miami</h2>
                            <p class="mb-0">Vuelo directo • 15 Mar 2024</p>
                        </div>
                        <div class="text-end">
                            <div class="rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <small>4.5/5 (2,847 reseñas)</small>
                        </div>
                    </div>
                    
                    <div class="flight-route">
                        <div class="airport-info">
                            <div class="airport-code">EZE</div>
                            <div class="airport-name">Buenos Aires</div>
                            <div class="airport-name">08:30</div>
                        </div>
                        
                        <div class="flight-line">
                            <div class="flight-duration">8h 45m</div>
                        </div>
                        
                        <div class="airport-info">
                            <div class="airport-code">MIA</div>
                            <div class="airport-name">Miami</div>
                            <div class="airport-name">14:15</div>
                        </div>
                    </div>
                    
                    <div class="airline-info">
                        <div class="airline-logo">
                            <i class="fas fa-plane text-primary"></i>
                        </div>
                        <div>
                            <strong>American Airlines</strong><br>
                            <small>Boeing 777-300ER • AA 1205</small>
                        </div>
                    </div>
                </div>

                <!-- Alert Info -->
                <div class="alert-info">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle text-primary me-3"></i>
                        <div>
                            <strong>¡Oferta por tiempo limitado!</strong><br>
                            <small>Este precio especial vence en 2 horas. ¡Reservá ahora!</small>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-tabs nav-tabs-custom mb-4" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#detalles">
                            <i class="fas fa-info-circle me-2"></i>Detalles del vuelo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#equipaje">
                            <i class="fas fa-suitcase me-2"></i>Equipaje
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#servicios">
                            <i class="fas fa-concierge-bell me-2"></i>Servicios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#politicas">
                            <i class="fas fa-file-alt me-2"></i>Políticas
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Detalles Tab -->
                    <div class="tab-pane fade show active" id="detalles">
                        <div class="detail-card">
                            <h5 class="detail-title">Información del vuelo</h5>
                            <div class="info-row">
                                <span class="info-label">Aerolínea</span>
                                <span class="info-value">American Airlines</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Número de vuelo</span>
                                <span class="info-value">AA 1205</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Aeronave</span>
                                <span class="info-value">Boeing 777-300ER</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Duración</span>
                                <span class="info-value">8h 45m</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Clase</span>
                                <span class="info-value">Económica</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Escalas</span>
                                <span class="info-value">Vuelo directo</span>
                            </div>
                        </div>

                        <div class="detail-card">
                            <h5 class="detail-title">Horarios</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><i class="fas fa-plane-departure text-primary me-2"></i>Salida</h6>
                                    <p class="mb-1"><strong>08:30</strong> - 15 Mar 2024</p>
                                    <p class="text-muted mb-0">Aeropuerto Internacional Ezeiza (EZE)</p>
                                    <small class="text-muted">Terminal A - Puerta 12</small>
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="fas fa-plane-arrival text-primary me-2"></i>Llegada</h6>
                                    <p class="mb-1"><strong>14:15</strong> - 15 Mar 2024</p>
                                    <p class="text-muted mb-0">Aeropuerto Internacional de Miami (MIA)</p>
                                    <small class="text-muted">Terminal D - Puerta 8</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Equipaje Tab -->
                    <div class="tab-pane fade" id="equipaje">
                        <div class="detail-card">
                            <h5 class="detail-title">Equipaje incluido</h5>
                            <div class="baggage-info">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><i class="fas fa-suitcase text-primary me-2"></i>Equipaje de mano</h6>
                                        <p class="mb-1">1 pieza incluida</p>
                                        <small class="text-muted">Máximo 8kg - 55x40x20cm</small>
                                    </div>
                                    <div class="col-md-6">
                                        <h6><i class="fas fa-luggage-cart text-primary me-2"></i>Equipaje facturado</h6>
                                        <p class="mb-1">1 pieza incluida</p>
                                        <small class="text-muted">Máximo 23kg</small>
                                    </div>
                                </div>
                            </div>
                            
                            <h6>Equipaje adicional</h6>
                            <div class="info-row">
                                <span class="info-label">Equipaje de mano extra</span>
                                <span class="info-value">$45 USD</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Equipaje facturado extra (hasta 23kg)</span>
                                <span class="info-value">$75 USD</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Sobrepeso (23-32kg)</span>
                                <span class="info-value">$100 USD</span>
                            </div>
                        </div>
                    </div>

                    <!-- Servicios Tab -->
                    <div class="tab-pane fade" id="servicios">
                        <div class="detail-card">
                            <h5 class="detail-title">Servicios incluidos</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="amenity-item">
                                        <i class="fas fa-wifi"></i>
                                        <span>WiFi gratuito</span>
                                    </div>
                                    <div class="amenity-item">
                                        <i class="fas fa-utensils"></i>
                                        <span>Comida incluida</span>
                                    </div>
                                    <div class="amenity-item">
                                        <i class="fas fa-glass-water"></i>
                                        <span>Bebidas incluidas</span>
                                    </div>
                                    <div class="amenity-item">
                                        <i class="fas fa-tv"></i>
                                        <span>Entretenimiento a bordo</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="amenity-item">
                                        <i class="fas fa-plug"></i>
                                        <span>Toma de corriente</span>
                                    </div>
                                    <div class="amenity-item">
                                        <i class="fas fa-headphones"></i>
                                        <span>Auriculares incluidos</span>
                                    </div>
                                    <div class="amenity-item">
                                        <i class="fas fa-blanket"></i>
                                        <span>Manta y almohada</span>
                                    </div>
                                    <div class="amenity-item">
                                        <i class="fas fa-user-tie"></i>
                                        <span>Servicio de tripulación</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="detail-card">
                            <h5 class="detail-title">Servicios opcionales</h5>
                            <div class="info-row">
                                <span class="info-label">Selección de asiento</span>
                                <span class="info-value">Desde $25 USD</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Asiento con espacio extra</span>
                                <span class="info-value">$85 USD</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Comida especial</span>
                                <span class="info-value">$35 USD</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Seguro de viaje</span>
                                <span class="info-value">$45 USD</span>
                            </div>
                        </div>
                    </div>

                    <!-- Políticas Tab -->
                    <div class="tab-pane fade" id="politicas">
                        <div class="detail-card">
                            <h5 class="detail-title">Políticas de cambio y cancelación</h5>
                            
                            <h6 class="mt-4">Cambios</h6>
                            <p>Los cambios están permitidos con las siguientes condiciones:</p>
                            <ul>
                                <li>Cambio de fecha: $150 USD + diferencia de tarifa</li>
                                <li>Cambio de nombre: $200 USD (solo errores menores)</li>
                                <li>Los cambios deben realizarse al menos 24 horas antes del vuelo</li>
                            </ul>

                            <h6 class="mt-4">Cancelaciones</h6>
                            <p>Política de cancelación:</p>
                            <ul>
                                <li>Cancelación gratuita: Dentro de las 24 horas de la compra</li>
                                <li>Cancelación con penalidad: $250 USD después de 24 horas</li>
                                <li>No reembolsable: 7 días antes del vuelo</li>
                            </ul>

                            <h6 class="mt-4">Check-in</h6>
                            <ul>
                                <li>Check-in online: 24 horas antes del vuelo</li>
                                <li>Llegada al aeropuerto: 3 horas antes (vuelos internacionales)</li>
                                <li>Documentación requerida: Pasaporte vigente</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-booking">
                    <div class="detail-card">
                        <div class="price-highlight mb-4">
                            <div>Precio total</div>
                            <div>$899 USD</div>
                            <small style="font-size: 0.8rem; opacity: 0.9;">por persona</small>
                        </div>

                        <div class="mb-3">
                            <h6>Resumen de la reserva</h6>
                            <div class="info-row">
                                <span class="info-label">Vuelo</span>
                                <span class="info-value">$750</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Tasas e impuestos</span>
                                <span class="info-value">$149</span>
                            </div>
                            <hr>
                            <div class="info-row">
                                <span class="info-label"><strong>Total</strong></span>
                                <span class="info-value"><strong>$899</strong></span>
                            </div>
                        </div>

                        <button class="btn btn-book mb-3">
                            <i class="fas fa-credit-card me-2"></i>Reservar ahora
                        </button>

                        <div class="text-center">
                            <small class="text-muted">
                                <i class="fas fa-shield-alt me-1"></i>
                                Compra 100% segura y protegida
                            </small>
                        </div>
                    </div>

                    <div class="detail-card">
                        <h6><i class="fas fa-phone text-primary me-2"></i>¿Necesitás ayuda?</h6>
                        <p class="mb-2">Nuestros expertos están disponibles 24/7</p>
                        <p class="mb-0">
                            <strong>+54 11 4000-1234</strong><br>
                            <small class="text-muted">Llamada gratuita</small>
                        </p>
                    </div>

                    <div class="detail-card">
                        <h6><i class="fas fa-star text-warning me-2"></i>¿Por qué elegirnos?</h6>
                        <div class="amenity-item">
                            <i class="fas fa-check text-success"></i>
                            <span>Mejor precio garantizado</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-check text-success"></i>
                            <span>Cancelación gratuita 24h</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-check text-success"></i>
                            <span>Atención al cliente 24/7</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-check text-success"></i>
                            <span>+20 años de experiencia</span>
                        </div>
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