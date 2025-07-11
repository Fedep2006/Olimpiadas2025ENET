<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Frategar - Resultados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    :root { 
      --primary: #0066cc; 
      --light: #f8f9fa; 
      --orange: #ff6600;
    }
    
    body { 
      background: var(--light); 
    }
    
    .navbar-brand { 
      font-weight: 700; 
      font-size: 1.75rem; 
      color: var(--primary)!important; 
    }
    
    .hero { 
      position: relative; 
      background: url('/images/hero-bg.jpg') center/cover no-repeat; 
      height: 350px; /* Aumentado para dar más espacio al buscador */
    }
    
    /* Estilo mejorado para el buscador */
    .search-card { 
      position: absolute; 
      left: 50%; 
      bottom: -30px; 
      transform: translateX(-50%); 
      width: 90%; 
      max-width: 900px; 
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px; 
      box-shadow: 0 15px 50px rgba(0,0,0,0.2); 
      padding: 30px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.3s ease;
    }
    
    .search-card:hover {
      transform: translateX(-50%) translateY(-5px);
      box-shadow: 0 20px 60px rgba(0,0,0,0.25);
    }
    
    /* Estilos para los campos de entrada */
    .input-group.input-elevated {
      border: none;
      border-radius: 15px;
      padding: 0.5rem;
      min-height: 60px;
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
      color: var(--primary);
    }
    
    .form-label {
      color: #495057;
      font-size: 0.85rem;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }
    
    /* Botón de búsqueda mejorado */
    .btn-search {
      background: linear-gradient(135deg, var(--orange), #ff8533);
      border: none;
      border-radius: 50px;
      padding: 12px 40px;
      font-weight: bold;
      color: white;
      box-shadow: 0 5px 15px rgba(255,102,0,0.3);
      transition: all 0.3s ease;
    }
    
    .btn-search:hover {
      background: linear-gradient(135deg, #ff8533, var(--orange));
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(255,102,0,0.4);
    }
    
    .results-section { 
      padding-top: 80px; /* Aumentado para dar espacio al buscador */
    }
    
    .result-card { 
      background: #fff; 
      border-radius: 12px; 
      box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
      margin-bottom: 1rem; 
      transition: transform .2s; 
      overflow: hidden;
    }
    
    .result-card:hover { 
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .result-body { 
      padding: 1.25rem; 
      display: flex; 
      justify-content: space-between; 
      align-items: center; 
    }
    
    .result-info { 
      flex: 1; 
    }
    
    .badge-type { 
      background: var(--primary); 
      text-transform: uppercase; 
      font-size: .75rem; 
      padding: 0.35em 0.65em;
    }
    
    .item-price { 
      font-size: 1.25rem; 
      font-weight: 600;
      color: var(--orange);
    }
    
    .footer-section { 
      background: #2c3e50; 
      color: #fff; 
      padding: 2rem 0; 
    }
    
    .features-section .fas { 
      color: var(--primary); 
    }
    
    /* Estilos para las pestañas */
    .nav-tabs .nav-link {
      color: #495057;
      border: none;
      border-bottom: 2px solid transparent;
      padding: 0.75rem 1rem;
      font-weight: 500;
      transition: all 0.2s ease;
    }
    
    .nav-tabs .nav-link.active {
      color: var(--primary);
      background: transparent;
      border-bottom: 2px solid var(--primary);
    }
    
    .nav-tabs .nav-link:hover:not(.active) {
      border-color: rgba(0, 102, 204, 0.3);
    }
    
    /* Ajuste responsivo para fechas en móviles */
    @media (max-width: 768px) {
      .date-col {
        width: 50%;
      }
      
      .search-card {
        padding: 20px;
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

  @php
    $hasFilters = request()->hasAny(['origin','destination','checkin','checkout','guests','price_min','price_max']);
  @endphp

  <!-- Hero + Filters -->
  <section class="hero">
    <div class="search-card">
      <h5 class="mb-3 fw-bold"><i class="fas fa-filter me-2 text-primary"></i>Filtros de búsqueda</h5>
      <form action="{{ route('results.index') }}" method="GET">
        <div class="row g-3">
          <!-- Origen -->
          <div class="col-md-3">
            <label class="form-label fw-bold mb-2">
              <i class="fas fa-dot-circle me-2 text-primary"></i>ORIGEN
            </label>
            <div class="input-group input-elevated">
              <span class="input-group-text bg-transparent border-0">
                <i class="fas fa-plane-departure"></i>
              </span>
              <input type="text" name="origin" class="form-control border-0" placeholder="Ciudad de origen" id="input-origin" autocomplete="off" list="list-origin" value="{{ request('origin') }}">
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
              <input type="text" name="destination" class="form-control border-0" placeholder="Ciudad de destino" id="input-destination" autocomplete="off" list="list-destination" value="{{ request('destination') }}">
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
              <input type="date" name="checkin" class="form-control border-0" placeholder="Fecha de ida" value="{{ request('checkin') }}">
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
              <input type="date" name="checkout" class="form-control border-0" placeholder="Fecha de vuelta" value="{{ request('checkout') }}">
            </div>
          </div>

        </div>
        
        <!-- Botón Aplicar Filtros -->
        <div class="text-center mt-4">
          <button class="btn btn-search rounded-pill px-5 py-2">
            <i class="fas fa-filter me-2"></i>Aplicar filtros
          </button>
        </div>
      </form>
    </div>
  </section>

  <!-- Results -->
  <section class="results-section container">
    @php
      $tabs = ['viajes'=>'Viajes','hospedajes'=>'Hospedajes','vehiculos'=>'Vehículos','paquetes'=>'Paquetes'];
      $totalAll = collect($results)->flatten(1)->count();
    @endphp

    <ul class="nav nav-tabs justify-content-center border-0 mb-4">
      {{-- La pestaña 'all' no es una opción por defecto, se activa si no hay otra --}}
      @php $defaultTab = !isset($tab) || !in_array($tab, array_keys($tabs)); @endphp

      <li class="nav-item"><button class="nav-link {{ $defaultTab ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tab-all">Todos ({{ $totalAll }})</button></li>

      @foreach($tabs as $key=>$label)
        <li class="nav-item"><button class="nav-link {{ (isset($tab) && $tab == $key) ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $key }}">{{ $label }} ({{ $results[$key]->count() }})</button></li>
      @endforeach
    </ul>

    <div class="tab-content">
      <div class="tab-pane fade {{ $defaultTab ? 'show active' : '' }}" id="tab-all">
        {{-- VIAJES EXACTOS --}}
        <h5 class="mt-3 mb-2"><i class="fas fa-plane text-primary me-2"></i>Viajes</h5>
        @forelse($results['viajes'] as $item)
          @php $type = 'viaje'; @endphp
          <div class="result-card">
            <a href="{{ route('details.show', ['tipo'=>$type,'id'=>$item->id]) }}" class="text-decoration-none text-dark">
              <div class="result-body">
                <div class="result-info">
                  <span class="badge bg-primary badge-type">{{ strtoupper($type) }}</span>
                  <div class="fw-semibold mt-1">
                    {{ $item->nombre }} ({{ $item->origen }} → {{ $item->destino }})
                    <br>
                    <small class="text-muted">
                      {{ \Carbon\Carbon::parse($item->fecha_salida)->format('d/m/Y') }}
                      &rarr;
                      {{ \Carbon\Carbon::parse($item->fecha_llegada)->format('d/m/Y') }}
                    </small>
                  </div>
                </div>
                <div class="text-end">
                  <div class="item-price">
                    ${{ number_format($item->precio_base ?? $item->precio,2) }}
                  </div>
                </div>
              </div>
            </a>
          </div>
        @empty
          <p class="text-center text-muted">No hay viajes.</p>
        @endforelse

        {{-- VIAJES CERCANOS --}}
        @if(isset($viajes_cercanos) && count($viajes_cercanos) > 0)
          <div class="alert alert-info mt-4 mb-2 text-center">
            <strong>Fechas cercanas</strong> (±3 días)
          </div>
          @foreach($viajes_cercanos as $item)
            <div class="result-card border border-info">
              <a href="{{ route('details.show', ['tipo'=>'viaje','id'=>$item->id]) }}" class="text-decoration-none text-dark">
                <div class="result-body">
                  <div class="result-info">
                    <span class="badge bg-info text-dark badge-type">VIAJE CERCANO</span>
                    <div class="fw-semibold mt-1">
                      {{ $item->nombre }} ({{ $item->origen }} → {{ $item->destino }})
                      <br>
                      <small class="text-muted">
                        {{ \Carbon\Carbon::parse($item->fecha_salida)->format('d/m/Y') }}
                        &rarr;
                        {{ \Carbon\Carbon::parse($item->fecha_llegada)->format('d/m/Y') }}
                      </small>
                    </div>
                  </div>
                  <div class="text-end">
                    <div class="item-price">
                      ${{ number_format($item->precio_base ?? $item->precio,2) }}
                    </div>
                  </div>
                </div>
              </a>
            </div>
          @endforeach
        @endif

        {{-- HOSPEDAJES --}}
        <h5 class="mt-4 mb-2"><i class="fas fa-hotel text-success me-2"></i>Hospedajes</h5>
        @forelse($results['hospedajes'] as $item)
          <div class="result-card">
            <a href="{{ route('details.show', ['tipo'=>'hospedaje','id'=>$item->id]) }}" class="text-decoration-none text-dark">
              <div class="result-body">
                <div class="result-info">
                  <span class="badge bg-success badge-type">HOSPEDAJE</span>
                  <div class="fw-semibold mt-1">
                    {{ $item->nombre }}
                    @if(isset($item->estrellas))
                      <span class="text-warning ms-2">
                        @for($i = 0; $i < $item->estrellas; $i++)
                          <i class="fas fa-star"></i>
                        @endfor
                      </span>
                    @endif
                  </div>
                </div>
                <div class="text-end">
                  <div class="item-price">
                    ${{ number_format($item->precio_noche,2) }}<small>/noche</small>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @empty
          <p class="text-center text-muted">No hay hospedajes.</p>
        @endforelse

        {{-- VEHÍCULOS --}}
        <h5 class="mt-4 mb-2"><i class="fas fa-car text-warning me-2"></i>Vehículos</h5>
        @forelse($results['vehiculos'] as $item)
          <div class="result-card">
            <a href="{{ route('vehiculos.show', $item->id) }}" class="text-decoration-none text-dark">
              <div class="result-body">
                <div class="result-info">
                  <span class="badge bg-warning text-dark badge-type">VEHÍCULO</span>
                  <div class="fw-semibold mt-1">
                    {{ $item->marca }} {{ $item->modelo }}
                  </div>
                </div>
                <div class="text-end">
                  <div class="item-price">
                    ${{ number_format($item->precio_por_dia,2) }}<small>/día</small>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @empty
          <p class="text-center text-muted">No hay vehículos.</p>
        @endforelse

        {{-- PAQUETES --}}
        <h5 class="mt-4 mb-2"><i class="fas fa-box text-secondary me-2"></i>Paquetes</h5>
        @forelse($results['paquetes'] as $item)
          <div class="result-card">
            <a href="{{ route('details.show', ['tipo'=>'paquete','id'=>$item->id]) }}" class="text-decoration-none text-dark">
              <div class="result-body">
                <div class="result-info">
                  <span class="badge bg-secondary badge-type">PAQUETE</span>
                  <div class="fw-semibold mt-1">
                    {{ $item->nombre }}
                  </div>
                </div>
                <div class="text-end">
                  <div class="item-price">
                    ${{ number_format($item->precio_total ?? $item->precio,2) }}
                  </div>
                </div>
              </div>
            </a>
          </div>
        @empty
          <p class="text-center text-muted">No hay paquetes.</p>
        @endforelse
      </div>
      @php
        $singularTypes = ['viajes'=>'viaje','hospedajes'=>'hospedaje','vehiculos'=>'vehiculo','paquetes'=>'paquete'];
      @endphp
      @foreach($results as $key => $items)
        <div class="tab-pane fade {{ (isset($tab) && $tab == $key) ? 'show active' : '' }}" id="tab-{{ $key }}">
          {{-- Título de sección según el tipo --}}
          @if($key=='viajes')
            <h5 class="mt-3 mb-2"><i class="fas fa-plane text-primary me-2"></i>Viajes</h5>
          @elseif($key=='hospedajes')
            <h5 class="mt-3 mb-2"><i class="fas fa-hotel text-success me-2"></i>Hospedajes</h5>
          @elseif($key=='vehiculos')
            <h5 class="mt-3 mb-2"><i class="fas fa-car text-warning me-2"></i>Vehículos</h5>
          @elseif($key=='paquetes')
            <h5 class="mt-3 mb-2"><i class="fas fa-box text-secondary me-2"></i>Paquetes</h5>
          @endif
          @forelse($results[$key] as $item)
            @php $type = $singularTypes[$key] ?? $key; @endphp
            <div class="result-card">
              <a href="{{ route('details.show', ['tipo'=>$type,'id'=>$item->id]) }}" class="text-decoration-none text-dark">
                <div class="result-body">
                  <div class="result-info">
                    <span class="badge bg-primary badge-type">{{ strtoupper($type) }}</span>
                    <div class="fw-semibold mt-1">
                      @if($type=='viajes')
                        {{ $item->nombre }} ({{ $item->origen }} → {{ $item->destino }})
                      @elseif($type=='vehiculos')
                        {{ $item->marca }} {{ $item->modelo }}
                      @elseif($type=='hospedajes')
                        {{ $item->nombre }}
                        @if(isset($item->estrellas))
                          <span class="text-warning ms-2">
                            @for($i = 0; $i < $item->estrellas; $i++)
                              <i class="fas fa-star"></i>
                            @endfor
                          </span>
                        @endif
                      @else
                        {{ $item->nombre }}
                      @endif
                    </div>
                  </div>
                  <div class="text-end">
                    <div class="item-price">
                      @if($type=='viajes')
                        ${{ number_format($item->precio_base ?? $item->precio,2) }}
                      @elseif($type=='hospedajes')
                        ${{ number_format($item->precio_noche,2) }}<small>/noche</small>
                      @elseif($type=='vehiculos')
                        ${{ number_format($item->precio_por_dia,2) }}<small>/día</small>
                      @else
                        ${{ number_format($item->precio_total ?? $item->precio,2) }}
                      @endif
                    </div>
                  </div>
                </div>
              </a>
            </div>
          @empty
            <p class="text-center text-muted">No hay resultados en {{ $label }}.</p>
          @endforelse
        </div>
      @endforeach
    </div>
    <div class="text-center mt-4">
      <a href="/" class="btn btn-outline-primary rounded-pill px-4 py-2">
        <i class="fas fa-home me-2"></i>Volver al inicio
      </a>
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
  
  <!-- Script para mejorar la visualización de fechas en móviles -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Asegurarse de que los campos de fecha tengan suficiente espacio
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => {
      input.addEventListener('focus', function() {
        this.style.width = '100%';
      });
    });
  });
  </script>
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