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
    </style>
</head>
<body>
    <script>console.log('TEST: Script al inicio del BODY ejecutado.');</script>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-plane-departure text-primary"></i> Frategar
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/paquetes"><i class="fas fa-box-open"></i> Paquetes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/vehiculos"><i class="fas fa-car"></i> Vehículos</a></li>
                    <li class="nav-item"><a class="nav-link" href="/nosotros"><i class="fas fa-info-circle"></i> Sobre Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container main-container">
        @php
            $type = isset($item->capacidad) ? 'hospedaje' : 'vehiculo';
            $precio_por_dia = $item->precio_por_dia ?? $item->precio_por_noche;
            $nombre_item = $item->nombre ?? ($item->marca . ' ' . $item->modelo);

            $imagenPrincipal = 'https://via.placeholder.com/800x600.png/CCCCCC/FFFFFF?text=Imagen+no+disponible';
            if (!empty($item->imagenes)) {
                if (is_string($item->imagenes) && (str_starts_with($item->imagenes, 'http') || file_exists(public_path(str_replace('/storage', 'storage', $item->imagenes))))) {
                    $imagenPrincipal = asset($item->imagenes);
                } elseif (is_array($item->imagenes) && !empty($item->imagenes[0])) {
                    $imagenPrincipal = asset($item->imagenes[0]);
                }
            }
        @endphp

        <div class="row g-4">
            <!-- Columna Izquierda: Imagen y Detalles -->
            <div class="col-lg-8">
                <div class="item-card">
                    <div class="item-image-container">
                        <img src="{{ $imagenPrincipal }}" alt="Imagen de {{ $nombre_item }}" class="item-image">
                    </div>
                </div>

                <div class="item-details">
                    <h2 class="details-title">Detalles del {{ $type === 'hospedaje' ? 'Hospedaje' : 'Vehículo' }}</h2>
                    <div class="details-grid">
                        @if($type === 'hospedaje')
                            <div class="detail-item"><i class="fas fa-map-marker-alt"></i> <div><span class="detail-label">Ubicación:</span><span class="detail-value">{{ $item->ubicacion }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-users"></i> <div><span class="detail-label">Capacidad:</span><span class="detail-value">{{ $item->capacidad }} personas</span></div></div>
                            <div class="detail-item"><i class="fas fa-bed"></i> <div><span class="detail-label">Habitaciones:</span><span class="detail-value">{{ $item->habitaciones }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-bath"></i> <div><span class="detail-label">Baños:</span><span class="detail-value">{{ $item->baños }}</span></div></div>
                        @else
                            <div class="detail-item"><i class="fas fa-car"></i> <div><span class="detail-label">Tipo:</span><span class="detail-value">{{ $item->tipo }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-cogs"></i> <div><span class="detail-label">Transmisión:</span><span class="detail-value">{{ $item->transmision }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-gas-pump"></i> <div><span class="detail-label">Motor:</span><span class="detail-value">{{ $item->motor }}</span></div></div>
                            <div class="detail-item"><i class="fas fa-user-friends"></i> <div><span class="detail-label">Pasajeros:</span><span class="detail-value">{{ $item->pasajeros }}</span></div></div>
                        @endif
                    </div>
                </div>

                @if(!empty($item->caracteristicas))
                <div class="characteristics-section">
                    <h3 class="details-title">Características Adicionales</h3>
                    <ul class="characteristics-list">
                        @foreach($item->caracteristicas as $caracteristica)
                            <li class="characteristic-item"><i class="fas fa-check-circle"></i> {{ $caracteristica }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <!-- Columna Derecha: Panel de Reserva -->
            <div class="col-lg-4">
                <div class="booking-panel sticky-top p-3">
                    
                    <form action="{{ route('reservar.store') }}" method="POST" id="bookingForm" class="p-3">
                        <h3 class="reserve-header mb-3">Completa tu Reserva</h3>
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="tipo_item" value="{{ $type }}">
                        <input type="hidden" name="precio_total" id="precio_total_hidden">
                        <input type="hidden" name="fecha_inicio" id="fecha_inicio_hidden">
                        <input type="hidden" name="fecha_fin" id="fecha_fin_hidden">

                        <div class="price-display">
                            ${{ number_format($precio_por_dia, 2) }}
                            <span class="price-period">por {{ $type === 'hospedaje' ? 'noche' : 'día' }}</span>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fecha_inicio" class="form-label">{{ $type === 'hospedaje' ? 'Check-in' : 'Fecha de Retiro' }}</label>
                            <input type="date" id="fecha_inicio" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fecha_fin" class="form-label">{{ $type === 'hospedaje' ? 'Check-out' : 'Fecha de Devolución' }}</label>
                            <input type="date" id="fecha_fin" class="form-control" required>
                        </div>
                        
                        <hr>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', auth()->user()->name ?? '') }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                            </div>
                        </div>
                        
                        <h5 class="mt-3 mb-3">Detalles del Pago</h5>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="card-number" class="form-label">Número de Tarjeta</label>
                                <input type="text" class="form-control" id="card-number" name="card_number" placeholder="**** **** **** ****" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expiry-date" class="form-label">Vencimiento</label>
                                <input type="text" class="form-control" id="expiry-date" name="expiry_date" placeholder="MM/YY" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
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
            // --- LÓGICA DE CÁLCULO DE PRECIO ---
            const fechaInicioEl = document.getElementById('fecha_inicio');
            const fechaFinEl = document.getElementById('fecha_fin');
            const totalAPagarEl = document.getElementById('total-a-pagar');
            const precioTotalHiddenEl = document.getElementById('precio_total_hidden');
            const fechaInicioHiddenEl = document.getElementById('fecha_inicio_hidden');
            const fechaFinHiddenEl = document.getElementById('fecha_fin_hidden');

            const precioPorUnidad = {{ $precio_por_dia }};
            const tipoItem = '{{ $type }}';

            function calcularTotal() {
                const fechaInicio = fechaInicioEl.value;
                const fechaFin = fechaFinEl.value;

                if (fechaInicio && fechaFin) {
                    const inicio = new Date(fechaInicio);
                    const fin = new Date(fechaFin);

                    if (fin > inicio) {
                        const diffTiempo = fin.getTime() - inicio.getTime();
                        let diffDias = Math.ceil(diffTiempo / (1000 * 3600 * 24));
                        
                        if(tipoItem === 'vehiculo') {
                            diffDias = diffDias > 0 ? diffDias + 1 : 1;
                        }

                        if (diffDias <= 0) diffDias = 1;

                        const total = diffDias * precioPorUnidad;
                        
                        totalAPagarEl.textContent = `$${total.toLocaleString('es-AR', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                        precioTotalHiddenEl.value = total.toFixed(2);
                        fechaInicioHiddenEl.value = fechaInicio;
                        fechaFinHiddenEl.value = fechaFin;
                    } else {
                        totalAPagarEl.textContent = '$0.00';
                        precioTotalHiddenEl.value = '0.00';
                    }
                } else {
                    totalAPagarEl.textContent = '$0.00';
                    precioTotalHiddenEl.value = '0.00';
                }
            }

            if(fechaInicioEl && fechaFinEl) {
                const hoy = new Date();
                const manana = new Date(hoy);
                manana.setDate(hoy.getDate() + 1);
                
                fechaInicioEl.setAttribute('min', manana.toISOString().split('T')[0]);
                fechaFinEl.disabled = true; 

                fechaInicioEl.addEventListener('change', () => {
                    if (fechaInicioEl.value) {
                        const fechaInicioSeleccionada = new Date(fechaInicioEl.value);
                        const fechaMinFin = new Date(fechaInicioSeleccionada);
                        fechaMinFin.setDate(fechaInicioSeleccionada.getDate() + 2);
                        fechaFinEl.setAttribute('min', fechaMinFin.toISOString().split('T')[0]);
                        fechaFinEl.disabled = false;
                    } else {
                        fechaFinEl.disabled = true;
                    }
                    calcularTotal();
                });

                fechaFinEl.addEventListener('change', calcularTotal);
            }

            @if ($errors->any())
                document.getElementById('bookingForm').scrollIntoView({ behavior: 'smooth', block: 'center' });
            @endif
        });
    </script>
</body>
</html>

                        if (diffDias <= 0) diffDias = 1;

                        const total = diffDias * precioPorUnidad;
                        
                        totalAPagarEl.textContent = `$${total.toFixed(2)}`;
                        totalAPagarModalEl.textContent = `$${total.toFixed(2)}`;
                        precioTotalHiddenEl.value = total.toFixed(2);
                        fechaInicioHiddenEl.value = fechaInicio;
                        fechaFinHiddenEl.value = fechaFin;

                    } else {
                        totalAPagarEl.textContent = '$0.00';
                        totalAPagarModalEl.textContent = '$0.00';
                        precioTotalHiddenEl.value = '0.00';
                    }
                } else {
                    totalAPagarEl.textContent = '$0.00';
                    totalAPagarModalEl.textContent = '$0.00';
                    precioTotalHiddenEl.value = '0.00';
                }
            }

            if(fechaInicioEl && fechaFinEl) {
                fechaInicioEl.addEventListener('change', calcularTotal);
                fechaFinEl.addEventListener('change', calcularTotal);
                const hoy = new Date().toISOString().split('T')[0];
                fechaInicioEl.setAttribute('min', hoy);
                fechaFinEl.setAttribute('min', hoy);
            }

            @if ($errors->any())
                console.log('Errores de validación de Laravel detectados. Abriendo modal.');
                const modalPorError = new bootstrap.Modal(document.getElementById('paymentModal'));
                modalPorError.show();
            @endif
        });
    </script>
</body>
</html>
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
                                <span id="precio_total_display">${{ number_format($item->precio_por_dia, 2) }}</span>
                                <span class="price-period">por día</span>
                            </div>
                            <button type="button" class="btn btn-primary w-100 py-3 fw-bold" data-bs-toggle="modal" data-bs-target="#reservaPagoModal" {{ !$item->disponible ? 'disabled' : '' }}>
                                <i class="fas fa-calendar-check me-2"></i> {{ $item->disponible ? 'Reservar Ahora' : 'No Disponible' }}
                            </button>

                            <!-- Modal con pestañas -->
                            <div class="modal fade" id="reservaPagoModal" tabindex="-1" aria-labelledby="reservaPagoModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  @if ($type === 'vehiculo')
                                  <form id="formReservaPago" action="{{ route('vehiculos.reservar', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="vehiculo_id" value="{{ $item->id }}">
                                    
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
                                      <h5 class="modal-title" id="reservaPagoModalLabel">Reservar Vehículo - {{ $item->marca }} {{ $item->modelo }}</h5>
                                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <!-- Columna izquierda - Resumen de la reserva -->
                                        <div class="col-md-5 border-end">
                                          <h6 class="fw-bold mb-3">Resumen de la reserva</h6>
                                          <div class="card bg-light mb-3">
                                            <div class="card-body p-3">
                                              <h6 class="card-title fw-bold">{{ $item->marca }} {{ $item->modelo }}</h6>
                                              <p class="card-text small mb-1">{{ $item->tipo }} • {{ $item->capacidad_pasajeros }} pasajeros</p>
                                              <p class="card-text small mb-2">{{ $item->ubicacion }}</p>
                                              <hr class="my-2">
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="small">Precio por día:</span>
                                                <span class="fw-bold" id="precio_dia">${{ number_format($item->precio_por_dia, 2) }}</span>
                                              </div>
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="small">Cantidad de días:</span>
                                                <span class="fw-bold" id="dias_reserva">0</span>
                                              </div>
                                              <hr class="my-2">
                                              <div class="d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">Total a pagar:</span>
                                                <span class="h5 mb-0 text-primary" id="total_pagar">$0.00</span>
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
                                  @elseif ($type === 'hospedaje')
                                  <form id="formReservaHospedaje" action="{{ route('hospedajes.storeReserva') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="hospedaje_id" value="{{ $item->id }}">
                                    <input type="hidden" name="noches" id="cantidad_noches_hidden">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="hospedaje_fecha_inicio" class="form-label">Fecha de Entrada</label>
                                            <input type="date" class="form-control" id="hospedaje_fecha_inicio" name="fecha_inicio" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="hospedaje_fecha_fin" class="form-label">Fecha de Salida</label>
                                            <input type="date" class="form-control" id="hospedaje_fecha_fin" name="fecha_fin" required>
                                        </div>
                                    </div>
                                    <div class="alert alert-info">Total de noches: <strong id="total_noches_display">0</strong></div>
                                    <hr>
                                    <h5 class="mb-3">Información de Pago</h5>
                                    <div class="form-group">
                                        <label for="cardholder_name" class="form-label">Nombre del Titular</label>
                                        <input type="text" class="form-control" name="cardholder_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="card_number" class="form-label">Número de Tarjeta</label>
                                        <input type="text" class="form-control" name="card_number" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="expiration_month" class="form-label">Mes Exp.</label>
                                            <input type="text" class="form-control" name="expiration_month" placeholder="MM" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="expiration_year" class="form-label">Año Exp.</label>
                                            <input type="text" class="form-control" name="expiration_year" placeholder="YYYY" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" name="cvv" required>
                                    </div>
                                    <button type="submit" class="reserve-button w-100 mt-3">Pagar y Reservar <span id="hospedaje_precio_total_display_modal"></span></button>
                                  </form>
                                  @endif
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
                                const precioPorDia = parseFloat({{ $item->precio_por_dia }});
                                
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
                                const type = '{{ $type }}';
                                const item = @json($item);

                                if (type === 'vehiculo') {
                                    const precioPorDia = parseFloat(item.precio_por_dia);
                                    const fechaInicioEl = document.getElementById('fecha_inicio');
                                    const cantidadDiasEl = document.getElementById('cantidad_dias');
                                    const fechaFinEl = document.getElementById('fecha_fin');
                                    const precioTotalDisplay = document.getElementById('precio_total_display');
                                    const precioTotalBtn = document.getElementById('precio_total_btn');
                                    const precioTotalModal = document.getElementById('precio_total_display_modal');

                                    function calcularVehiculo() {
                                        if (!fechaInicioEl.value) return;
                                        const dias = parseInt(cantidadDiasEl.value) || 1;
                                        const inicio = new Date(fechaInicioEl.value);
                                        inicio.setDate(inicio.getDate() + dias);
                                        fechaFinEl.value = inicio.toISOString().split('T')[0];
                                        const total = dias * precioPorDia;
                                        if(precioTotalDisplay) precioTotalDisplay.innerText = `$${total.toFixed(2)}`;
                                        if(precioTotalBtn) precioTotalBtn.innerText = `$${total.toFixed(2)}`;
                                        if(precioTotalModal) precioTotalModal.innerText = `$${total.toFixed(2)}`;
                                        document.getElementById('precio_total_hidden').value = total.toFixed(2);
                                    }
                                    fechaInicioEl.addEventListener('change', calcularVehiculo);
                                    cantidadDiasEl.addEventListener('input', calcularVehiculo);
                                    calcularVehiculo();

                                } else if (type === 'hospedaje') {
                                    const precioPorNoche = parseFloat(item.precio_por_noche);
                                    const fechaInicioEl = document.getElementById('hospedaje_fecha_inicio');
                                    const fechaFinEl = document.getElementById('hospedaje_fecha_fin');
                                    const nochesDisplay = document.getElementById('total_noches_display');
                                    const nochesHidden = document.getElementById('cantidad_noches_hidden');
                                    const precioTotalDisplay = document.getElementById('precio_total_display');
                                    const precioTotalBtn = document.getElementById('precio_total_btn');
                                    const precioTotalModal = document.getElementById('hospedaje_precio_total_display_modal');

                                    function calcularHospedaje() {
                                        if (!fechaInicioEl.value || !fechaFinEl.value) return;
                                        const inicio = new Date(fechaInicioEl.value);
                                        const fin = new Date(fechaFinEl.value);
                                        if (fin <= inicio) {
                                            if(nochesDisplay) nochesDisplay.innerText = '0';
                                            return;
                                        }
                                        const diffTime = Math.abs(fin - inicio);
                                        const noches = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                        if(nochesDisplay) nochesDisplay.innerText = noches;
                                        if(nochesHidden) nochesHidden.value = noches;
                                        const total = noches * precioPorNoche;
                                        if(precioTotalDisplay) precioTotalDisplay.innerText = `$${total.toFixed(2)}`;
                                        if(precioTotalBtn) precioTotalBtn.innerText = `$${total.toFixed(2)}`;
                                        if(precioTotalModal) precioTotalModal.innerText = `$${total.toFixed(2)}`;
                                    }
                                    fechaInicioEl.addEventListener('change', calcularHospedaje);
                                    fechaFinEl.addEventListener('change', calcularHospedaje);
                                }
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
