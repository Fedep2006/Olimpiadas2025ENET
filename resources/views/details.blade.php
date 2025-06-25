<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de {{ $item->nombre ?? ($item->marca . ' ' . $item->modelo) }} - Frategar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --frategar-blue: #0d6efd;
            --frategar-orange: #fd7e14;
            --frategar-light-blue: #e6f0ff;
        }

        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--frategar-blue) !important;
        }

        .main-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            flex: 1;
        }

        .item-card, .item-details, .booking-panel, .characteristics-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .item-image-container {
            position: relative;
            height: 450px;
            overflow: hidden;
        }

        .item-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .item-details, .booking-panel, .characteristics-section {
            padding: 24px;
            margin-top: 24px;
        }

        .booking-panel {
            padding: 0;
        }

        .reserve-header {
            background: var(--frategar-blue);
            color: white;
            padding: 18px 24px;
            font-size: 20px;
            font-weight: 600;
        }

        .booking-content {
            padding: 24px;
        }

        .price-display {
            font-size: 2.1rem;
            font-weight: 700;
            color: var(--frategar-orange);
            margin-bottom: 24px;
        }

        .price-period {
            font-size: 1rem;
            color: #6c757d;
            font-weight: normal;
            margin-left: 8px;
        }

        .form-label {
            font-size: 0.9rem;
            color: #343a40;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 1rem;
            width: 100%;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--frategar-blue);
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
            outline: none;
        }

        .reserve-button {
            background: linear-gradient(135deg, var(--frategar-orange), #ff9a4e);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px 0;
            font-size: 1.2rem;
            font-weight: bold;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(253, 126, 20, 0.3);
        }

        .reserve-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(253, 126, 20, 0.4);
        }

        .details-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--frategar-blue);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--frategar-light-blue);
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            font-size: 1rem;
        }

        .detail-item i {
            color: var(--frategar-blue);
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .detail-label {
            font-weight: 600;
            color: #343a40;
            margin-right: 8px;
        }

        .detail-value {
            color: #6c757d;
        }

        .characteristics-list {
            list-style: none;
            padding: 0;
            margin: 0;
            columns: 2;
            gap: 10px;
        }

        .characteristic-item {
            padding: 8px 0;
            color: #343a40;
            display: flex;
            align-items: center;
        }

        .characteristic-item i {
            color: #28a745;
            margin-right: 10px;
        }

        .modal-content {
            border-radius: 16px;
            border: none;
        }

        .modal-header {
            background-color: var(--frategar-blue);
            color: white;
            border-bottom: none;
            border-radius: 16px 16px 0 0;
        }

        .modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        #total-a-pagar-modal {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--frategar-orange);
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 20px auto;
                padding: 0 15px;
            }
            .item-image-container {
                height: 280px;
            }
            .characteristics-list {
                columns: 1;
            }
        }

        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            margin-top: auto;
        }

        .footer-section h5 {
            color: white;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section hr {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .footer-section .social-links a {
            color: white;
            margin-right: 15px;
            font-size: 20px;
        }

        .footer-section .social-links a:hover {
            color: var(--frategar-orange);
        }
    </style>
</head>
<body>
    <script>console.log('TEST: Script al inicio del BODY ejecutado.');</script>
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
                        <li class="nav-item">
                            <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Ingresar</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endauth

                    <!-- Ayuda -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container main-container">
@php
            // La variable $tipo se pasa desde el controlador y es la fuente de verdad.
            $precio_por_dia = $item->precio_por_dia ?? $item->precio_por_noche ?? $item->precio_base ?? $item->precio_total;
            $nombre_item = $item->nombre ?? ($item->marca . ' ' . $item->modelo);
        @endphp

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="row g-4">
            <!-- Columna Izquierda: Detalles -->
            <div class="col-lg-8">
                <div class="item-details">
                    <h2 class="details-title">Detalles del {{ ucfirst($tipo) }}</h2>
                    <div class="details-grid">
                        @if($tipo === 'hospedaje')
                            {{-- Información General --}}
                            <div class="detail-item"><i class="fas fa-building"></i> <div><span class="detail-label">Empresa:</span><span class="detail-value">{{ $item->empresa->nombre ?? 'No especificada' }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-hotel"></i> <div><span class="detail-label">Tipo:</span><span class="detail-value">{{ $item->tipo }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-star"></i> <div><span class="detail-label">Estrellas:</span><span class="detail-value">{{ $item->estrellas }} / 5</span></div></div>
                            <div class="detail-item"><i class="fas fa-thumbs-up"></i> <div><span class="detail-label">Calificación:</span><span class="detail-value">{{ $item->calificacion ? $item->calificacion . ' / 10' : 'N/A' }}</span></div></div>

                            {{-- Capacidad y Habitaciones --}}
                            <div class="detail-item"><i class="fas fa-users"></i> <div><span class="detail-label">Capacidad:</span><span class="detail-value">{{ $item->capacidad_personas }} personas</span></div></div>
                            <div class="detail-item"><i class="fas fa-door-open"></i> <div><span class="detail-label">Tipo Habitación:</span><span class="detail-value">{{ $item->habitacion }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-bed"></i> <div><span class="detail-label">Habitaciones Disp:</span><span class="detail-value">{{ $item->habitaciones_disponibles }}</span></div></div>
                            
                            {{-- Ubicación --}}
                            <div class="detail-item"><i class="fas fa-map-marker-alt"></i> <div><span class="detail-label">Dirección:</span><span class="detail-value">{{ $item->ubicacion }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-city"></i> <div><span class="detail-label">Ciudad:</span><span class="detail-value">{{ $item->ciudad->nombre ?? 'No especificada' }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-map"></i> <div><span class="detail-label">Provincia:</span><span class="detail-value">{{ $item->provincia->nombre ?? 'No especificada' }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-globe-americas"></i> <div><span class="detail-label">País:</span><span class="detail-value">{{ $item->pais->nombre ?? 'No especificado' }}</span></div></div>

                            {{-- Horarios --}}
                            <div class="detail-item"><i class="fas fa-clock"></i> <div><span class="detail-label">Check-in:</span><span class="detail-value">{{ $item->check_in ? \Carbon\Carbon::parse($item->check_in)->format('H:i') . ' hs' : 'No especificado' }}</span></div></div>
                            <div class="detail-item"><i class="far fa-clock"></i> <div><span class="detail-label">Check-out:</span><span class="detail-value">{{ $item->check_out ? \Carbon\Carbon::parse($item->check_out)->format('H:i') . ' hs' : 'No especificado' }}</span></div></div>
                        @elseif($tipo === 'vehiculo')
                            {{-- Vehiculo --}}
                            <div class="detail-item"> <i class="fas fa-car"></i> <div><span class="detail-label">Marca:</span><span class="detail-value">{{ $item->marca }}</span></div></div>
                            <div class="detail-item"> <i class="fas fa-car-side"></i> <div><span class="detail-label">Modelo:</span><span class="detail-value">{{ $item->modelo }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-user-friends"></i> <div><span class="detail-label">Pasajeros:</span><span class="detail-value">{{ $item->capacidad_pasajeros }}</span></div></div>
                        @elseif($tipo === 'paquete')
                            {{-- Información General del Paquete --}}
                            <div class="detail-item"><i class="fas fa-box"></i> <div><span class="detail-label">Nombre:</span><span class="detail-value">{{ $item->nombre }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-clock"></i> <div><span class="detail-label">Duración:</span><span class="detail-value">{{ $item->duracion }} días</span></div></div>
                            <div class="detail-item"><i class="fas fa-map-marker-alt"></i> <div><span class="detail-label">Ubicación:</span><span class="detail-value">{{ $item->ubicacion }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-users"></i> <div><span class="detail-label">Cupo:</span><span class="detail-value">{{ $item->cupo_minimo }} - {{ $item->cupo_maximo }} personas</span></div></div>
                            <div class="detail-item"><i class="fas fa-hashtag"></i> <div><span class="detail-label">Número de Paquete:</span><span class="detail-value">{{ $item->numero_paquete }}</span></div></div>
                            @if($item->descripcion)
                            <div class="detail-item"><i class="fas fa-info-circle"></i> <div><span class="detail-label">Descripción:</span><span class="detail-value">{{ $item->descripcion }}</span></div></div>
                            @endif
                        @elseif ($tipo === 'viaje')
                                                        {{-- Viaje --}}
                            <div class="detail-item"><i class="fas fa-building"></i> <div><span class="detail-label">Empresa:</span><span class="detail-value">{{ $item->empresa->nombre ?? 'No especificada' }}</span></div></div>

                            <div class="detail-item"><i class="fas fa-plane-departure"></i> <div><span class="detail-label">Origen:</span><span class="detail-value">{{ $item->origen }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-plane-arrival"></i> <div><span class="detail-label">Destino:</span><span class="detail-value">{{ $item->destino }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-calendar-alt"></i> <div><span class="detail-label">Salida:</span><span class="detail-value">{{ \Carbon\Carbon::parse($item->fecha_salida)->format('d/m/Y H:i') }}</span></div></div>
                            @if(!empty($item->fecha_llegada))
    <div class="detail-item"><i class="fas fa-calendar-check"></i> <div><span class="detail-label">Llegada:</span><span class="detail-value">{{ \Carbon\Carbon::parse($item->fecha_llegada)->format('d/m/Y H:i') }}</span></div></div>
@endif
                            <div class="detail-item"><i class="fas fa-chair"></i> <div><span class="detail-label">Asientos Disp:</span><span class="detail-value">{{ $item->asientos_disponibles }}</span></div></div>
                        @endif   
                    </div>
                </div>

                {{-- Contenido del Paquete --}}
                @if($tipo === 'paquete' && $item->contenidos->count() > 0)
                    <div class="item-details mt-4">
                        <h3 class="details-title">Contenido del Paquete</h3>
                        
                        @foreach($item->contenidos as $contenido)
                            <div class="card mb-3">
                                <div class="card-body">
                                    @php
                                        $contenidoItem = $contenido->contenido;
                                        $tipoContenido = class_basename($contenido->contenido_type);
                                    @endphp

                                    <h5 class="card-title">
                                        @if($tipoContenido === 'Hospedaje')
                                            <i class="fas fa-hotel text-primary"></i> Hospedaje
                                        @elseif($tipoContenido === 'Vehiculo')
                                            <i class="fas fa-car text-success"></i> Vehículo
                                        @elseif($tipoContenido === 'Viaje')
                                            <i class="fas fa-plane text-info"></i> Viaje
                                        @endif
                                    </h5>

                                    <div class="details-grid mt-3">
                                        @if($tipoContenido === 'Hospedaje')
                                            <div class="detail-item"><i class="fas fa-building"></i> <div><span class="detail-label">Nombre:</span><span class="detail-value">{{ $contenidoItem->nombre }}</span></div></div>
                                            <div class="detail-item"><i class="fas fa-map-marker-alt"></i> <div><span class="detail-label">Ubicación:</span><span class="detail-value">{{ $contenidoItem->ubicacion }}</span></div></div>
                                            <div class="detail-item"><i class="fas fa-star"></i> <div><span class="detail-label">Estrellas:</span><span class="detail-value">{{ $contenidoItem->estrellas }} / 5</span></div></div>
                                            <div class="detail-item"><i class="fas fa-bed"></i> <div><span class="detail-label">Tipo:</span><span class="detail-value">{{ $contenidoItem->tipo }}</span></div></div>
                                        @elseif($tipoContenido === 'Vehiculo')
                                            <div class="detail-item"><i class="fas fa-car"></i> <div><span class="detail-label">Vehículo:</span><span class="detail-value">{{ $contenidoItem->marca }} {{ $contenidoItem->modelo }}</span></div></div>
                                            <div class="detail-item"><i class="fas fa-users"></i> <div><span class="detail-label">Capacidad:</span><span class="detail-value">{{ $contenidoItem->capacidad_pasajeros }} pasajeros</span></div></div>
                                            <div class="detail-item"><i class="fas fa-map-marker-alt"></i> <div><span class="detail-label">Ubicación:</span><span class="detail-value">{{ $contenidoItem->ubicacion }}</span></div></div>
                                        @elseif($tipoContenido === 'Viaje')
                                            <div class="detail-item"><i class="fas fa-plane-departure"></i> <div><span class="detail-label">Origen:</span><span class="detail-value">{{ $contenidoItem->origen }}</span></div></div>
                                            <div class="detail-item"><i class="fas fa-plane-arrival"></i> <div><span class="detail-label">Destino:</span><span class="detail-value">{{ $contenidoItem->destino }}</span></div></div>
                                            <div class="detail-item"><i class="fas fa-calendar"></i> <div><span class="detail-label">Salida:</span><span class="detail-value">{{ $contenidoItem->fecha_salida ? \Carbon\Carbon::parse($contenidoItem->fecha_salida)->format('d/m/Y H:i') : 'No especificada' }}</span></div></div>
                                            @if($contenidoItem->fecha_llegada)
                                                <div class="detail-item"><i class="fas fa-calendar-check"></i> <div><span class="detail-label">Llegada:</span><span class="detail-value">{{ \Carbon\Carbon::parse($contenidoItem->fecha_llegada)->format('d/m/Y H:i') }}</span></div></div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Descripción, Condiciones y Contacto (solo para hospedaje) --}}
                @if($tipo === 'hospedaje')
                    @if($item->descripcion)
                    <div class="item-details mt-4">
                        <h3 class="details-title">Descripción</h3>
                        <p class="text-secondary" style="white-space: pre-wrap;">{{ $item->descripcion }}</p>
                    </div>
                    @endif

                    @if($item->condiciones)
                    <div class="item-details mt-4">
                        <h3 class="details-title">Condiciones</h3>
                        <p class="text-secondary" style="white-space: pre-wrap;">{{ $item->condiciones }}</p>
                    </div>
                    @endif

                    <div class="item-details mt-4">
                        <h3 class="details-title">Contacto</h3>
                        <div class="details-grid">
                            @if($item->telefono)
                            <div class="detail-item"><i class="fas fa-phone"></i> <div><span class="detail-label">Teléfono:</span><span class="detail-value">{{ $item->telefono }}</span></div></div>
                            @endif
                            @if($item->email)
                            <div class="detail-item"><i class="fas fa-envelope"></i> <div><span class="detail-label">Email:</span><span class="detail-value"><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></span></div></div>
                            @endif
                            @if($item->sitio_web)
                            <div class="detail-item"><i class="fas fa-globe"></i> <div><span class="detail-label">Sitio Web:</span><span class="detail-value"><a href="{{ $item->sitio_web }}" target="_blank" rel="noopener noreferrer">{{ $item->sitio_web }}</a></span></div></div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- This is for vehiculo characteristics, which seems to be a different field --}}
                @if($tipo !== 'hospedaje' && !empty($item->caracteristicas))
                <div class="characteristics-section">
                    <h3 class="details-title">Características Adicionales</h3>
                    <ul class="characteristics-list">
                        @foreach(is_array($item->caracteristicas) ? $item->caracteristicas : json_decode($item->caracteristicas, true) as $caracteristica)
                            <li class="characteristic-item"><i class="fas fa-check-circle"></i> {{ $caracteristica }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Columna Derecha: Panel de Reserva -->
            <div class="col-lg-4">
                <div class="booking-panel sticky-top p-3">
                    
                    <form id="booking-form" method="POST" action="{{ route('reservar.store') }}">
                        <h3 class="reserve-header mb-3">Completa tu Reserva</h3>
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="item_type" value="{{ $tipo }}">
                        <input type="hidden" name="total_pagar" id="total_pagar_hidden" value="0">

                        <div class="price-display">
                            ${{ number_format($precio_por_dia, 2) }}
                            <span class="price-period">/ {{ $tipo === 'hospedaje' ? 'noche' : ($tipo === 'paquete' ? 'paquete' : 'día') }}</span>
                        </div>

                        @if ($tipo === 'viaje')
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label">Fecha de Salida</label>
        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $item->fecha_salida->format('Y-m-d') }}" readonly>
    </div>
    <div class="col-md-6">
        <label class="form-label">Fecha de Llegada</label>
        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ $item->fecha_llegada ? $item->fecha_llegada->format('Y-m-d') : '' }}" readonly>
    </div>
</div>
@elseif ($tipo === 'paquete')
<p class="text-muted mb-3">Este paquete no requiere selección de fechas.</p>
<input type="hidden" name="fecha_inicio" id="fecha_inicio" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
<input type="hidden" name="fecha_fin" id="fecha_fin" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
@else
<div class="form-group mb-3">
    <div class="col-6">
        <label for="fecha_inicio" class="form-label">{{ $tipo === 'hospedaje' ? 'Check-in' : 'Fecha de Retiro' }}</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio') }}" required>
        @error('fecha_inicio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6">
        <label for="fecha_fin" class="form-label">{{ $tipo === 'hospedaje' ? 'Check-out' : 'Fecha de Devolución' }}</label>
        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ old('fecha_fin') }}" required>
        @error('fecha_fin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
@endif

                        <hr>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre Completo</label>
                                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre como aparece en la tarjeta" required value="{{ old('nombre', Auth::user()->name ?? '') }}">
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email de Contacto</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="tucorreo@ejemplo.com" required value="{{ old('email', Auth::user()->email ?? '') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-3 mb-3">Detalles del Pago</h5>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="card_number" class="form-label">Número de Tarjeta</label>
                                    <input type="text" name="card_number" class="form-control @error('card_number') is-invalid @enderror" id="card_number" placeholder="0000 0000 0000 0000" required value="{{ old('card_number') }}">
                                    @error('card_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="card_expiry" class="form-label">Vencimiento</label>
                                <input type="text" name="card_expiry" class="form-control @error('card_expiry') is-invalid @enderror" id="card_expiry" placeholder="MM/AA" required value="{{ old('card_expiry') }}">
                                @error('card_expiry')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="card_cvc" class="form-label">CVC</label>
                                <input type="text" name="card_cvc" class="form-control @error('card_cvc') is-invalid @enderror" id="card_cvc" placeholder="123" required value="{{ old('card_cvc') }}">
                                @error('card_cvc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold fs-5">Total a Pagar:</span>
                            <span id="total-a-pagar" class="fw-bold fs-4" style="color: var(--frategar-orange);">$0.00</span>
                        </div>

                        <button type="submit" class="btn reserve-button w-100 mt-2">Confirmar y Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fechaInicioEl = document.getElementById('fecha_inicio');
            const fechaFinEl = document.getElementById('fecha_fin');
            const totalAPagarEl = document.getElementById('total-a-pagar');
            const totalPagarHiddenEl = document.getElementById('total_pagar_hidden');

            if (!fechaInicioEl || !fechaFinEl || !totalAPagarEl || !totalPagarHiddenEl) {
                console.error('Error: Faltan elementos esenciales del formulario de reserva en el DOM.');
                return;
            }

            const precioPorUnidad = {{ $precio_por_dia }};
            const tipoItem = '{{ $tipo }}';

            function calcularTotal() {
                const fechaInicio = fechaInicioEl.value;
                const fechaFin = fechaFinEl.value;
                let total = 0;

                if (tipoItem === 'viaje' || tipoItem === 'paquete') {
                    total = precioPorUnidad;
                } else if (fechaInicio && fechaFin) {
                    const inicio = new Date(fechaInicio);
                    const fin = new Date(fechaFin);

                    if (fin > inicio) {
                        const diffTiempo = fin.getTime() - inicio.getTime();
                        let diffDias = Math.ceil(diffTiempo / (1000 * 3600 * 24));

                        if (tipoItem === 'vehiculo') {
                            diffDias = diffDias > 0 ? diffDias + 1 : 1;
                        }
                        if (diffDias <= 0 && tipoItem === 'hospedaje') {
                            diffDias = 1;
                        }
                        total = diffDias > 0 ? diffDias * precioPorUnidad : 0;
                    }
                }
                totalAPagarEl.textContent = `$${total.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                totalPagarHiddenEl.value = total;
            }

            function validarFechas() {
                // Para viajes y paquetes, las fechas son fijas y no deben validarse ni modificarse.
                if (tipoItem === 'viaje' || tipoItem === 'paquete') {
                    return;
                }

                const hoy = new Date().toISOString().split('T')[0];
                fechaInicioEl.min = hoy;

                if (fechaInicioEl.value) {
                    let minFechaFin = new Date(fechaInicioEl.value);
                    minFechaFin.setDate(minFechaFin.getDate() + 1);
                    fechaFinEl.min = minFechaFin.toISOString().split('T')[0];
                } else {
                    fechaFinEl.min = hoy;
                }

                if (fechaFinEl.value && fechaInicioEl.value >= fechaFinEl.value) {
                    fechaFinEl.value = '';
                }
            }

            fechaInicioEl.addEventListener('change', () => {
                validarFechas();
                calcularTotal();
            });
            fechaFinEl.addEventListener('change', calcularTotal);

            validarFechas();
            calcularTotal();
        });
    </script>

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
                        <li><a href="{{ route('results.index', ['tab' => 'viajes']) }}" class="text-light text-decoration-none">Vuelos</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'hospedajes']) }}" class="text-light text-decoration-none">Hoteles</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'paquetes']) }}" class="text-light text-decoration-none">Paquetes</a></li>
                        <li><a href="{{ route('results.index', ['tab' => 'vehiculos']) }}" class="text-light text-decoration-none">Autos</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5>Ayuda</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Centro de ayuda</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Contacto</a></li>
                        <li><a href="{{ route("terminos") }}" class="text-light text-decoration-none">Términos y condiciones</a></li>
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
</body>
</html>
