<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($vehiculo->marca ?? '') }} {{ ucfirst($vehiculo->modelo ?? '') }} - Detalles del Vehículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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
    <div class="main-container">
        <div class="row g-4">
            <!-- Left Column - Vehicle Image and Details -->
            <div class="col-lg-8">
                <div class="vehicle-card">
                    <div class="vehicle-image-container">
                        @if(!empty($vehiculo->imagenes))
                            @php
                                $imagenes = is_array($vehiculo->imagenes) ? $vehiculo->imagenes : (is_string($vehiculo->imagenes) ? explode(',', $vehiculo->imagenes) : []);
                                $primera_imagen = !empty($imagenes) && trim($imagenes[0]) !== '' ? asset($imagenes[0]) : '/images/vehicle-sample.jpg';
                            @endphp
                            <img src="{{ $primera_imagen }}" alt="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}" class="vehicle-image">
                        @else
                            <img src="/images/vehicle-sample.jpg" alt="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}" class="vehicle-image">
                        @endif
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
            </div>
            
            <!-- Right Column - Booking Panel -->
            <div class="col-lg-4">
                <div class="vehicle-card">
                    <div class="booking-panel">
                        <h4 class="reserve-header">Reserva ahora</h4>
                        <div class="booking-content">
                            <div class="price-display">
                                ${{ number_format($vehiculo->precio_por_dia, 2) }}
                                <span class="price-period">por día</span>
                            </div>
                            
                            <form>
                                <div class="form-group">
                                    <label class="form-label">Fecha de inicio</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Fecha de fin</label>
                                    <input type="date" class="form-control" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Cantidad de días</label>
                                    <input type="number" class="form-control" value="1" min="1">
                                </div>
                                
                                <button type="submit" class="reserve-button" {{ !$vehiculo->disponible ? 'disabled' : '' }}>
                                    <i class="fas fa-calendar-check me-2"></i>
                                    {{ $vehiculo->disponible ? 'Reservar ahora' : 'No disponible' }}
                                </button>
                            </form>
                            
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
