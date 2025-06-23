<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($vehiculo->marca ?? '') }} {{ ucfirst($vehiculo->modelo ?? '') }} - Detalles del Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
        }
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--despegar-blue) !important;
        }
        .section-title {
            font-size: 2.2rem;
            font-weight: bold;
            color: var(--despegar-blue);
            text-align: center;
            margin-bottom: 2rem;
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
        .vehicle-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.10);
            overflow: hidden;
            margin-bottom: 30px;
        }
        .vehicle-details {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .price-display {
            font-size: 28px;
            font-weight: 600;
            color: var(--despegar-orange);
            margin-bottom: 24px;
        }
        .price-period {
            font-size: 14px;
            color: #666;
            font-weight: normal;
            margin-left: 8px;
        }
        .reserve-header {
            background: var(--despegar-blue);
            color: white;
            padding: 18px 24px;
            font-size: 20px;
            font-weight: 600;
            border-radius: 16px 16px 0 0;
            margin: 0;
        }
        .booking-panel {
            background: white;
            padding: 0;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,102,204,0.08);
        }
        .booking-content {
            padding: 24px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-size: 14px;
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            width: 100%;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 3px rgba(0,102,204,0.08);
            outline: none;
        }
        .reserve-button {
            background: linear-gradient(135deg, var(--despegar-orange), #ff8533);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px 0;
            font-size: 1.1rem;
            font-weight: bold;
            width: 100%;
            margin-bottom: 24px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .reserve-button:hover {
            background: linear-gradient(135deg, #ff8533, var(--despegar-orange));
        }
        .modal-content {
            border-radius: 18px;
        }
        .nav-tabs .nav-link.active {
            background-color: var(--despegar-blue);
            color: #fff;
            border-radius: 25px 25px 0 0;
        }
        .nav-tabs .nav-link {
            color: var(--despegar-blue);
            border-radius: 25px 25px 0 0;
        }
        .trust-indicators {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .trust-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
            color: #333;
        }
        .trust-item:last-child {
            margin-bottom: 0;
        }
        .trust-icon {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .trust-icon.blue {
            background: var(--despegar-blue);
        }
        .trust-icon.green {
            background: #34a853;
        }
        @media (max-width: 768px) {
            .main-container {
                padding: 0 5px;
            }
            .section-title {
                font-size: 1.5rem;
            }
            .vehicle-image-container {
                height: 220px;
            }
        }
    
        .main-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .vehicle-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .vehicle-image-container {
            position: relative;
            height: 400px;
            overflow: hidden;
        }
        
        .vehicle-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .booking-panel {
            background: white;
            padding: 0;
        }
        
        .reserve-header {
            background: #1a73e8;
            color: white;
            padding: 16px 24px;
            font-size: 18px;
            font-weight: 500;
            margin: 0;
        }
        
        .booking-content {
            padding: 24px;
        }
        
        .price-display {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 24px;
        }
        
        .price-period {
            font-size: 14px;
            color: #666;
            font-weight: normal;
            margin-left: 8px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            font-size: 14px;
            color: #333;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            width: 100%;
            transition: border-color 0.2s;
        }
        
        .form-control:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
            outline: none;
        }
        
        .reserve-button {
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px 20px;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            margin-bottom: 24px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .reserve-button:hover {
            background: #1557b0;
        }
        
        .trust-indicators {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        
        .trust-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
            color: #333;
        }
        
        .trust-item:last-child {
            margin-bottom: 0;
        }
        
        .trust-icon {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            margin-right: 12px;
            flex-shrink: 0;
        }
        
        .trust-icon.blue {
            background: #1a73e8;
        }
        
        .trust-icon.green {
            background: #34a853;
        }
        
        .vehicle-details {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .details-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #333;
        }
        
        .detail-value {
            color: #666;
        }
        
        .characteristics-section {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .characteristics-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .characteristic-item {
            padding: 8px 0;
            color: #333;
        }
        
        .characteristic-item:before {
            content: "•";
            color: #1a73e8;
            font-weight: bold;
            margin-right: 8px;
        }
        
        @media (max-width: 768px) {
            .main-container {
                margin: 20px auto;
                padding: 0 15px;
            }
            
            .vehicle-image-container {
                height: 250px;
            }
            
            .booking-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
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

    <div class="main-container">
        <div class="row g-4">
            <!-- Left Column - Vehicle Image and Details -->
            <div class="col-lg-8">
                <div class="vehicle-card">
                    <div class="vehicle-image-container">
                        @php
                            // Soporta array de links o string simple
                            $img = $vehiculo->imagenes;
                            if (is_array($img)) {
                                // Busca el primer link válido
                                foreach ($img as $enlace) {
                                    $enlace = trim((string)$enlace);
                                    if ((filter_var($enlace, FILTER_VALIDATE_URL) && $enlace !== '') || (str_starts_with($enlace, 'data:image'))) {
                                        $primera_imagen = $enlace;
                                        break;
                                    } elseif (!empty($enlace)) {
                                        $primera_imagen = asset($enlace);
                                        break;
                                    }
                                }
                                if (empty($primera_imagen)) {
                                    $primera_imagen = asset('images/vehicle-sample.jpg');
                                }
                            } else {
                                $img = trim((string)$img);
                                if ((filter_var($img, FILTER_VALIDATE_URL)) || (str_starts_with($img, 'data:image'))) {
                                    $primera_imagen = $img;
                                } elseif (!empty($img)) {
                                    $primera_imagen = asset($img);
                                } else {
                                    $primera_imagen = asset('images/vehicle-sample.jpg');
                                }
                            }
                        @endphp
                        @php
                            $img = $vehiculo->imagenes;
                            if (is_string($img) && str_starts_with($img, '[')) {
                                $img = json_decode($img, true);
                            }
                        @endphp
                        <img src="{{ is_array($img) ? $img[0] : $img }}" alt="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}" class="vehicle-image">
                    </div>
                </div>
                
                <!-- Vehicle Details -->
                <div class="vehicle-details">
                    <h3 class="details-title">Detalles del vehículo</h3>
                    <div class="details-grid">
                        <div class="detail-item">
                            <span class="detail-label">ID:</span>
                            <span class="detail-value">{{ $vehiculo->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Año:</span>
                            <span class="detail-value">{{ $vehiculo->antiguedad }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tipo:</span>
                            <span class="detail-value">{{ $vehiculo->tipo }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Color:</span>
                            <span class="detail-value">{{ $vehiculo->color }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Marca:</span>
                            <span class="detail-value">{{ $vehiculo->marca }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Modelo:</span>
                            <span class="detail-value">{{ $vehiculo->modelo }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Patente:</span>
                            <span class="detail-value">{{ $vehiculo->patente }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Capacidad:</span>
                            <span class="detail-value">{{ $vehiculo->capacidad_pasajeros }} pasajeros</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Ubicación:</span>
                            <span class="detail-value">{{ $vehiculo->ubicacion }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Disponible:</span>
                            <span class="detail-value">{{ $vehiculo->disponible ? 'Sí' : 'No' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Characteristics -->
                @if(is_array($vehiculo->caracteristicas) && count($vehiculo->caracteristicas))
                <div class="characteristics-section">
                    <h3 class="details-title">Características</h3>
                    <ul class="characteristics-list">
                        @foreach($vehiculo->caracteristicas as $carac)
                        <li class="characteristic-item">{{ $carac }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Observations -->
                @if(!empty($vehiculo->observaciones))
                <div class="characteristics-section">
                    <h3 class="details-title">Observaciones</h3>
                    <p class="mb-0">{{ $vehiculo->observaciones }}</p>
                </div>
                @endif

                <!-- Pago Ficticio -->
                @if(session('status'))
                    <div class="alert alert-success mt-4">{{ session('status') }}</div>
                @endif
            </div>
            
            <!-- Right Column - Booking Panel -->
            @if(session('reserva_status'))
                <!-- Modal de éxito -->
                <div class="modal fade" id="reservaSuccessModal" tabindex="-1" aria-labelledby="reservaSuccessModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="reservaSuccessModalLabel">
                          <i class="fas fa-check-circle me-2"></i> ¡Reserva enviada!
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                      </div>
                      <div class="modal-body text-center">
                        <p class="mb-0 fs-5">{{ session('reserva_status') }}</p>
                      </div>
                      <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-success px-4" data-bs-dismiss="modal">Aceptar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    var reservaModal = new bootstrap.Modal(document.getElementById('reservaSuccessModal'));
                    reservaModal.show();
                  });
                </script>
            @endif
            <div class="col-lg-4">
                <div class="vehicle-card">
                    <div class="booking-panel">
                        <h4 class="reserve-header">Reserva ahora</h4>
                        <div class="booking-content">
                            <div class="price-display mb-4">
                                <span id="precio_total_display">${{ number_format($vehiculo->precio_por_dia, 2) }}</span>
                                <span class="price-period">por día</span>
                            </div>
                            <button type="button" class="btn btn-primary w-100 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#reservaPagoModal" {{ !$vehiculo->disponible ? 'disabled' : '' }}>
                                <i class="fas fa-calendar-check me-2"></i> {{ $vehiculo->disponible ? 'Reservar Ahora' : 'No Disponible' }}
                            </button>

                            <!-- Modal con pestañas -->
                            <div class="modal fade" id="reservaPagoModal" tabindex="-1" aria-labelledby="reservaPagoModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <form action="{{ url('vehiculos/' . $vehiculo->id . '/reservar') }}" method="POST" id="formReservaPago">
                                    @csrf
                                    <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">
                                    
                                    <!-- Mostrar errores generales -->
                                    @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="modal-header bg-primary text-white">
                                      <h5 class="modal-title" id="reservaPagoModalLabel">Reservar Vehículo - {{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h5>
                                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <!-- Columna izquierda - Resumen de la reserva -->
                                        <div class="col-md-5 border-end">
                                          <h6 class="fw-bold mb-3">Resumen de la reserva</h6>
                                          <div class="card bg-light mb-3">
                                            <div class="card-body p-3">
                                              <h6 class="card-title fw-bold">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h6>
                                              <p class="card-text small mb-1">{{ $vehiculo->tipo }} • {{ $vehiculo->capacidad_pasajeros }} pasajeros</p>
                                              <p class="card-text small mb-2">{{ $vehiculo->ubicacion }}</p>
                                              <hr class="my-2">
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="small">Precio por día:</span>
                                                <span class="fw-bold">$<span id="precio_dia">{{ number_format($vehiculo->precio_por_dia, 2) }}</span></span>
                                              </div>
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="small">Cantidad de días:</span>
                                                <span class="fw-bold" id="dias_reserva">0</span>
                                              </div>
                                              <hr class="my-2">
                                              <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">Total a pagar:</span>
                                                <span class="h5 mb-0 text-primary">$<span id="total_pagar">0.00</span></span>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="alert alert-info small p-2 mb-0">
                                            <i class="fas fa-info-circle me-1"></i> El pago se procesará al confirmar la reserva.
                                          </div>
                                        </div>
                                        
                                        <!-- Columna derecha - Formulario -->
                                        <div class="col-md-7">
                                          <ul class="nav nav-tabs" id="reservaPagoTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link active" id="reserva-tab" data-bs-toggle="tab" data-bs-target="#reserva" type="button" role="tab" aria-controls="reserva" aria-selected="true">
                                                <i class="far fa-calendar-alt me-1"></i> Fechas
                                              </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" id="pago-tab" data-bs-toggle="tab" data-bs-target="#pago" type="button" role="tab" aria-controls="pago" aria-selected="false">
                                                <i class="far fa-credit-card me-1"></i> Pago
                                              </button>
                                            </li>
                                          </ul>
                                          
                                          <div class="tab-content mt-3" id="reservaPagoTabsContent">
                                            <!-- Tab Reserva -->
                                            <div class="tab-pane fade show active" id="reserva" role="tabpanel" aria-labelledby="reserva-tab">
                                              <div class="row g-3">
                                                <div class="col-md-6">
                                                  <label for="fecha_retiro" class="form-label small fw-bold">Fecha de retiro</label>
                                                  <input type="date" class="form-control" id="fecha_retiro" name="fecha_retiro" required>
                                                </div>
                                                <div class="col-md-6">
                                                  <label for="fecha_devolucion" class="form-label small fw-bold">Fecha de devolución</label>
                                                  <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion" required>
                                                </div>
                                              </div>
                                              <div class="alert alert-warning small mt-3 p-2">
                                                <i class="fas fa-exclamation-triangle me-1"></i> Por favor, verifique las fechas seleccionadas antes de continuar.
                                              </div>
                                            </div>
                                            
                                            <!-- Tab Pago -->
                                            <div class="tab-pane fade" id="pago" role="tabpanel" aria-labelledby="pago-tab">
                                              <h6 class="fw-bold mb-3">Información de pago</h6>
                                              
                                              <div class="mb-3">
                                                <label class="form-label small fw-bold">Nombre del titular de la tarjeta</label>
                                                <input type="text" class="form-control" name="nombre_titular" placeholder="Como aparece en la tarjeta" required>
                                              </div>
                                              
                                              <div class="mb-3">
                                                <label class="form-label small fw-bold">Número de tarjeta</label>
                                                <div class="input-group">
                                                  <input type="text" class="form-control" name="numero_tarjeta" placeholder="1234 5678 9012 3456" required>
                                                  <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                                </div>
                                                <div class="form-text small">Aceptamos Visa, Mastercard, American Express</div>
                                              </div>
                                              
                                              <div class="row g-3">
                                                <div class="col-md-6">
                                                  <label class="form-label small fw-bold">Fecha de vencimiento</label>
                                                  <input type="text" class="form-control" name="fecha_vencimiento" placeholder="MM/AA" required>
                                                </div>
                                                <div class="col-md-6">
                                                  <label class="form-label small fw-bold">Código de seguridad (CVV)</label>
                                                  <div class="input-group">
                                                    <input type="text" class="form-control" name="cvv" placeholder="123" required>
                                                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="Los 3 dígitos en el reverso de su tarjeta">
                                                      <i class="fas fa-question-circle"></i>
                                                    </span>
                                                  </div>
                                                </div>
                                              </div>
                                              
                                              <div class="form-check mt-3">
                                                <input class="form-check-input" type="checkbox" id="terminos" required>
                                                <label class="form-check-label small" for="terminos">
                                                  Acepto los <a href="#" class="text-decoration-none">términos y condiciones</a> y la <a href="#" class="text-decoration-none">política de privacidad</a>
                                                </label>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-outline-secondary me-auto" id="btnAtras" style="display: none;">
                                        <i class="fas fa-arrow-left me-1"></i> Atrás
                                      </button>
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-1"></i> Cancelar
                                      </button>
                                      <button type="button" class="btn btn-primary" id="btnSiguiente">
                                        <i class="fas fa-arrow-right me-1"></i> Siguiente
                                      </button>
                                      <button type="submit" class="btn btn-success" id="btnReservar" style="display: none;">
                                        <span class="spinner-border spinner-border-sm d-none" id="spinner" role="status" aria-hidden="true"></span>
                                        <i class="fas fa-check-circle me-1"></i> Confirmar Pago
                                      </button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            
                            <!-- Script para el manejo del formulario de reserva -->
                            @push('scripts')
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.getElementById('formReservaPago');
                                const btnSiguiente = document.getElementById('btnSiguiente');
                                const btnAtras = document.getElementById('btnAtras');
                                const btnReservar = document.getElementById('btnReservar');
                                const reservaTab = document.getElementById('reserva-tab');
                                const pagoTab = document.getElementById('pago-tab');
                                const reservaPane = document.getElementById('reserva');
                                const pagoPane = document.getElementById('pago');
                                const reservaTabContent = document.getElementById('reservaPagoTabsContent');
                                
                                // Mostrar errores de validación si existen
                                @if($errors->any())
                                    // Mostrar pestaña de pago si hay errores en los campos de pago
                                    @if($errors->hasAny(['nombre_titular', 'numero_tarjeta', 'fecha_vencimiento', 'cvv']))
                                        reservaTab.classList.remove('active');
                                        pagoTab.classList.add('active');
                                        reservaPane.classList.remove('show', 'active');
                                        pagoPane.classList.add('show', 'active');
                                        btnSiguiente.style.display = 'none';
                                        btnAtras.style.display = 'inline-block';
                                        btnReservar.style.display = 'inline-block';
                                    @endif
                                @endif
                                const spinner = document.getElementById('spinner');
                                const precioPorDia = parseFloat({{ $vehiculo->precio_por_dia }});
                                
                                // Inicializar tooltips
                                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                                const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                                    return new bootstrap.Tooltip(tooltipTriggerEl);
                                });
                                
                                // Validar fechas al cambiar
                                const fechaRetiro = document.getElementById('fecha_retiro');
                                const fechaDevolucion = document.getElementById('fecha_devolucion');
                                const hoy = new Date().toISOString().split('T')[0];
                                
                                // Establecer fecha mínima (hoy)
                                fechaRetiro.min = hoy;
                                fechaDevolucion.min = hoy;
                                
                                // Calcular total al cambiar fechas
                                [fechaRetiro, fechaDevolucion].forEach(input => {
                                    input.addEventListener('change', calcularTotal);
                                });
                                
                                function calcularTotal() {
                                    if (fechaRetiro.value && fechaDevolucion.value) {
                                        const inicio = new Date(fechaRetiro.value);
                                        const fin = new Date(fechaDevolucion.value);
                                        
                                        // Si la fecha de devolución es anterior a la de retiro, corregir
                                        if (fin < inicio) {
                                            fechaDevolucion.value = fechaRetiro.value;
                                            calcularTotal();
                                            return;
                                        }
                                        
                                        // Calcular diferencia en días
                                        const diffTime = Math.abs(fin - inicio);
                                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // +1 para incluir ambos días
                                        
                                        // Actualizar total
                                        const total = diffDays * precioPorDia;
                                        document.getElementById('dias_reserva').textContent = diffDays;
                                        document.getElementById('total_pagar').textContent = total.toFixed(2);
                                    }
                                }
                                
                                // Navegación entre pestañas
                                const reservaTab = document.getElementById('reserva-tab');
                                const pagoTab = document.getElementById('pago-tab');
                                const reservaPane = document.getElementById('reserva');
                                const pagoPane = document.getElementById('pago');
                                
                                let currentTab = 'reserva';
                                
                                btnSiguiente.addEventListener('click', function() {
                                    if (currentTab === 'reserva') {
                                        // Validar fechas antes de continuar
                                        if (!fechaRetiro.value || !fechaDevolucion.value) {
                                            alert('Por favor, seleccione las fechas de retiro y devolución.');
                                            return;
                                        }
                                        
                                        // Cambiar a pestaña de pago
                                        currentTab = 'pago';
                                        reservaTab.classList.remove('active');
                                        reservaPane.classList.remove('show', 'active');
                                        pagoTab.classList.add('active');
                                        pagoPane.classList.add('show', 'active');
                                        
                                        // Actualizar botones
                                        btnSiguiente.style.display = 'none';
                                        btnAtras.style.display = 'block';
                                        btnReservar.style.display = 'block';
                                    }
                                });
                                
                                btnAtras.addEventListener('click', function() {
                                    if (currentTab === 'pago') {
                                        // Volver a pestaña de reserva
                                        currentTab = 'reserva';
                                        pagoTab.classList.remove('active');
                                        pagoPane.classList.remove('show', 'active');
                                        reservaTab.classList.add('active');
                                        reservaPane.classList.add('show', 'active');
                                        
                                        // Actualizar botones
                                        btnSiguiente.style.display = 'block';
                                        btnAtras.style.display = 'none';
                                        btnReservar.style.display = 'none';
                                    }
                                });
                                
                                // Función para mostrar errores en el formulario
                                function showFormErrors(errors) {
                                    // Limpiar errores anteriores
                                    const errorElements = form.querySelectorAll('.is-invalid');
                                    errorElements.forEach(el => el.classList.remove('is-invalid'));
                                    
                                    const feedbackElements = form.querySelectorAll('.invalid-feedback');
                                    feedbackElements.forEach(el => el.remove());
                                    
                                    // Mostrar nuevos errores
                                    Object.entries(errors).forEach(([field, messages]) => {
                                        const input = form.querySelector(`[name="${field}"]`);
                                        if (input) {
                                            input.classList.add('is-invalid');
                                            const errorDiv = document.createElement('div');
                                            errorDiv.className = 'invalid-feedback';
                                            errorDiv.textContent = messages[0];
                                            input.parentNode.appendChild(errorDiv);
                                            
                                            // Desplazarse al primer campo con error
                                            if (field === Object.keys(errors)[0]) {
                                                input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                            }
                                        }
                                    });
                                }
                                
                                // Manejar el envío del formulario
                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    
                                    // Mostrar spinner y deshabilitar botón
                                    spinner.style.display = 'inline-block';
                                    btnReservar.disabled = true;
                                    
                                    // Enviar formulario con Fetch API
                                    fetch(form.action, {
                                        method: 'POST',
                                        body: new FormData(form),
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest',
                                            'Accept': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                        }
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            return response.json().then(err => { throw err; });
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (data.redirect) {
                                            // Redirigir a la página de éxito si se proporciona una URL
                                            window.location.href = data.redirect;
                                        } else if (data.success) {
                                            // Mostrar mensaje de éxito y recargar
                                            const successHtml = `
                                                <div class="alert alert-success">
                                                    <i class="fas fa-check-circle me-2"></i>
                                                    ${data.message || '¡Reserva realizada con éxito!'}
                                                </div>`;
                                            
                                            // Reemplazar el contenido del modal con el mensaje de éxito
                                            document.querySelector('#reservaPagoModal .modal-content').innerHTML = `
                                                <div class="modal-header">
                                                    <h5 class="modal-title">¡Reserva Exitosa!</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body text-center py-4">
                                                    <div class="mb-3">
                                                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                                                    </div>
                                                    <h4 class="mb-3">¡Reserva confirmada!</h4>
                                                    <p class="mb-0">${data.message || 'Tu reserva ha sido procesada exitosamente.'}</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <a href="{{ route('mis-reservas') }}" class="btn btn-primary">
                                                        <i class="fas fa-calendar-check me-2"></i>Ver mis reservas
                                                    </a>
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-2"></i>Cerrar
                                                    </button>
                                                </div>`;
                                            
                                            // Cerrar automáticamente después de 3 segundos
                                            setTimeout(() => {
                                                const modal = bootstrap.Modal.getInstance(document.getElementById('reservaPagoModal'));
                                                if (modal) modal.hide();
                                                window.location.reload();
                                            }, 5000);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        
                                        // Mostrar errores de validación
                                        if (error.errors) {
                                            showFormErrors(error.errors);
                                            
                                            // Mostrar pestaña de reserva si hay errores en las fechas
                                            if (error.errors.fecha_retiro || error.errors.fecha_devolucion) {
                                                reservaTab.click();
                                            }
                                            // Mostrar pestaña de pago si hay errores en los datos de pago
                                            else if (error.errors.nombre_titular || error.errors.numero_tarjeta || 
                                                    error.errors.fecha_vencimiento || error.errors.cvv) {
                                                pagoTab.click();
                                            }
                                        } else {
                                            // Mostrar error general
                                            const errorHtml = `
                                                <div class="alert alert-danger">
                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                    ${error.message || 'Error al procesar la reserva. Por favor, inténtalo de nuevo.'}
                                                </div>`;
                                            
                                            // Insertar el mensaje de error al principio del formulario
                                            const formHeader = form.querySelector('.modal-header');
                                            if (formHeader) {
                                                formHeader.insertAdjacentHTML('afterend', errorHtml);
                                            }
                                        }
                                    })
                                    .finally(() => {
                                        // Ocultar spinner y habilitar botón
                                        spinner.style.display = 'none';
                                        btnReservar.disabled = false;
                                    });
                                });
                            </script>
                            @endpush
                            
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Función para calcular la fecha de fin basada en la fecha de inicio y días
                                function calcularFechaFin() {
                                    const inicio = document.getElementById('fecha_inicio');
                                    const dias = document.getElementById('cantidad_dias');
                                    const fechaFin = document.getElementById('fecha_fin');
                                    
                                    if (inicio && inicio.value && dias && dias.value) {
                                        const fecha = new Date(inicio.value);
                                        fecha.setDate(fecha.getDate() + parseInt(dias.value));
                                        const yyyy = fecha.getFullYear();
                                        const mm = String(fecha.getMonth() + 1).padStart(2, '0');
                                        const dd = String(fecha.getDate()).padStart(2, '0');
                                        fechaFin.value = `${yyyy}-${mm}-${dd}`;
                                    }
                                    actualizarPrecio();
                                }
                                
                                // Función para actualizar el precio total
                                function actualizarPrecio() {
                                    const dias = parseInt(document.getElementById('cantidad_dias').value || '1');
                                    const precioPorDia = {{ $vehiculo->precio_por_dia }};
                                    const total = dias * precioPorDia;
                                    document.getElementById('precio_total_display').innerText = `$${total.toFixed(2)}`;
                                    document.getElementById('precio_total_btn').innerText = `$${total.toFixed(2)}`;
                                }
                                
                                // Inicializar eventos
                                const fechaInicio = document.getElementById('fecha_inicio');
                                const cantidadDias = document.getElementById('cantidad_dias');
                                
                                if (fechaInicio) {
                                    fechaInicio.addEventListener('change', calcularFechaFin);
                                }
                                
                                if (cantidadDias) {
                                    cantidadDias.addEventListener('input', calcularFechaFin);
                                }
                                
                                // Calcular valores iniciales
                                calcularFechaFin();
                            });
                            </script>
                            
                            <div class="trust-indicators">
                                <div class="trust-item">
                                    <div class="trust-icon blue"></div>
                                    <span>Reserva segura</span>
                                </div>
                                <div class="trust-item">
                                    <div class="trust-icon green"></div>
                                    <span>Pago seguro con Mercado Pago</span>
                                </div>
                                <div class="trust-item">
                                    <div class="trust-icon green"></div>
                                    <span>Sin cargos ocultos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Back Button -->
        <div class="text-center mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al listado
            </a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Initialize modals
        var myModal = document.getElementById('reservaPagoModal');
        if (myModal) {
            myModal.addEventListener('show.bs.modal', function (event) {
                // Reset form when modal is shown
                var form = document.getElementById('formReservaPago');
                if (form) form.reset();
            });
        }
        
        // Show modal if there's an error
        @if($errors->any())
            var modal = new bootstrap.Modal(document.getElementById('reservaPagoModal'));
            modal.show();
        @endif
    });
    </script>
</body>
</html>
