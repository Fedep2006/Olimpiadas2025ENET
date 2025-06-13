<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Frategar - Resultados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    :root { --primary: #0066cc; --light: #f8f9fa; }
    body { background: var(--light); }
    .navbar-brand { font-weight: 700; font-size: 1.75rem; color: var(--primary) !important; }
    .hero { position: relative; background: url('/images/hero-bg.jpg') center/cover no-repeat; height: 300px; }
    .search-card { position: absolute; left: 50%; bottom: -30px; transform: translateX(-50%); width: 90%; max-width: 800px; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); padding: 1rem; }
    .results-section { padding-top: 60px; }
    .result-card { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 1rem; transition: transform .2s; }
    .result-card:hover { transform: translateY(-2px); }
    .result-body { padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
    .result-info { flex: 1; }
    .badge-type { background: var(--primary); text-transform: uppercase; font-size: .75rem; }
    .item-price { font-size: 1.1rem; font-weight: 600; }
    .footer-section { background: #2c3e50; color: #fff; padding: 2rem 0; }
    .features-section .fas { color: var(--primary); }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="/">
        <i class="fas fa-plane me-1 text-primary"></i> Frategar
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
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

  <!-- Hero + Search -->
  <section class="hero">
    <div class="search-card">
      <ul class="nav nav-tabs mb-3" id="searchModeTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link {{ request()->has('q') ? '' : 'active' }}" id="text-tab" data-bs-toggle="tab" data-bs-target="#text" type="button">Texto</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link {{ request()->has('q') ? 'active' : '' }}" id="advanced-tab" data-bs-toggle="tab" data-bs-target="#advanced" type="button">Preferencias</button>
        </li>
      </ul>
      <div class="tab-content" id="searchModeTabContent">
        <div class="tab-pane fade {{ request()->has('q') ? '' : 'show active' }}" id="text" role="tabpanel">
          <form action="{{ url('/results') }}" method="GET" class="d-flex">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Busca destino, hotel, auto o paquete" />
            <button class="btn btn-primary" type="submit"><i class="fas fa-search me-1"></i> Buscar</button>
          </form>
        </div>
        <div class="tab-pane fade {{ request()->has(['origin','destination','checkin','checkout','guests']) ? 'show active' : '' }}" id="advanced" role="tabpanel">
  <form action="{{ route('preferencias.buscar') }}" method="GET">
    <div class="row g-2 align-items-center">
      <div class="col-md-3">
        <label class="form-label small">Origen</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-dot-circle"></i></span>
          <input type="text" name="origin" class="form-control" placeholder="Ciudad de origen" value="{{ request('origin') }}" />
        </div>
      </div>
      <div class="col-md-3">
        <label class="form-label small">Destino</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
          <input type="text" name="destination" class="form-control" placeholder="Ciudad de destino" value="{{ request('destination') }}" />
        </div>
      </div>
      <div class="col-md-2">
        <label class="form-label small">Entrada</label>
        <input type="date" name="checkin" class="form-control" value="{{ request('checkin') }}" />
      </div>
      <div class="col-md-2">
        <label class="form-label small">Salida</label>
        <input type="date" name="checkout" class="form-control" value="{{ request('checkout') }}" />
      </div>
      <div class="col-md-2">
        <label class="form-label small">Huéspedes</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
          <input type="number" name="guests" min="1" class="form-control" value="{{ request('guests',1) }}" />
        </div>
      </div>
    </div>
    <div class="row g-2 align-items-center mt-3">
      <div class="col-md-3">
        <label class="form-label small">Precio mínimo</label>
        <div class="input-group">
          <span class="input-group-text">$</span>
          <input type="number" name="price_min" class="form-control" placeholder="0" value="{{ request('price_min') }}" />
        </div>
      </div>
      <div class="col-md-3">
        <label class="form-label small">Precio máximo</label>
        <div class="input-group">
          <span class="input-group-text">$</span>
          <input type="number" name="price_max" class="form-control" placeholder="0" value="{{ request('price_max') }}" />
        </div>
      </div>
      <div class="col-md-6 text-end">
        <button class="btn btn-primary mt-4"><i class="fas fa-filter me-1"></i> Aplicar filtros</button>
      </div>
    </div>
  </form>
</div>
      </div>
    </div>
  </section>

  <!-- Results -->
  <section class="results-section container">
    @if(request()->has('q'))
      <h2 class="mb-4">Resultados para: <strong>{{ request('q') }}</strong></h2>
      @if($results->isEmpty())
        <p class="text-muted">No se encontraron preferencias.</p>
      @else
        <div class="list-group">
          @foreach($results as $pref)
            <a href="#" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $pref->nombre }}</h5>
              </div>
              <p class="mb-1 text-muted">{{ $pref->descripcion ?? 'Sin descripción' }}</p>
            </a>
          @endforeach
        </div>
      @endif
      <div class="text-center mt-4">
        <a href="/" class="btn btn-outline-primary">← Volver al inicio</a>
      </div>
    @else
      <ul class="nav nav-tabs mb-4" id="tabs">
        @php $total = collect($results)->map->count()->sum(); @endphp
        <li class="nav-item"><button class="nav-link active" data-bs-target="#tab-all" data-bs-toggle="tab">Todos ({{ $total }})</button></li>
        @foreach(['vehiculos' => 'Vehículos', 'viajes' => 'Viajes', 'hospedajes' => 'Hospedajes', 'paquetes' => 'Paquetes'] as $key => $label)
          <li class="nav-item"><button class="nav-link" data-bs-target="#tab-{{ $key }}" data-bs-toggle="tab">{{ $label }} ({{ $results[$key]->count() ?? 0 }})</button></li>
        @endforeach
      </ul>
      <div class="tab-content">
        @foreach(array_merge(['all' => 'Todos'], ['vehiculos' => 'Vehículos', 'viajes' => 'Viajes', 'hospedajes' => 'Hospedajes', 'paquetes' => 'Paquetes']) as $key => $label)
          <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $key }}">
            @php $items = $key === 'all' ? collect($results)->flatten(1) : ($results[$key] ?? collect()); @endphp
            @forelse($items as $item)
              @php
                if($item instanceof \App\Models\Viaje) { $type='viajes'; }
                elseif($item instanceof \App\Models\Hospedaje) { $type='hospedajes'; }
                elseif($item instanceof \App\Models\Vehiculo) { $type='vehiculos'; }
                else { $type='paquetes'; }
              @endphp
              <div class="result-card">
                <a href="{{ url('/details', ['type'=>$type,'id'=>$item->id]) }}" class="text-decoration-none text-dark">
                  <div class="result-body">
                    <div class="result-info">
                      <span class="badge badge-pill bg-primary badge-type text-uppercase">{{ $type }}</span>
                      <div class="fw-semibold mt-1">
                        @if($type=='viajes')
                          {{ $item->nombre }} ({{ $item->origen }} → {{ $item->destino }})
                        @elseif($type=='vehiculos')
                          {{ $item->marca }} {{ $item->modelo }}
                        @else
                          {{ $item->nombre }}
                        @endif
                      </div>
                      @if($type=='viajes')<small class="text-muted">Ida y vuelta • {{ $item->duracion ?? '?' }}</small>@endif
                    </div>
                    <div class="text-end">
                      <div class="item-price">
                        @if($type=='viajes')
                          ${{ number_format($item->precio,2) }}
                        @elseif($type=='hospedajes')
                          ${{ number_format($item->precio_noche,2) }}<span class="small">/noche</span>
                        @elseif($type=='vehiculos')
                          ${{ number_format($item->precio_por_dia,2) }}<span class="small">/día</span>
                        @else
                          ${{ number_format($item->precio ?? 0,2) }}
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
        <a href="/" class="btn btn-outline-primary">← Volver al inicio</a>
      </div>
    @endif
  </section>

  <!-- Features -->
  <section class="features-section py-5 bg-white">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-3 mb-4">
          <i class="fas fa-shield-alt fa-2x mb-3"></i>
          <h6>Compra protegida</h6>
          <p class="small text-muted">Tu dinero está protegido con nosotros</p>
        </div>
        <div class="col-md-3 mb-4">
          <i class="fas fa-headset fa-2x mb-3"></i>
          <h6>Atención 24/7</h6>
          <p class="small text-muted">Te ayudamos cuando lo necesites</p>
        </div>
        <div class="col-md-3 mb-4">
          <i class="fas fa-percent fa-2x mb-3"></i>
          <h6>Mejores precios</h6>
          <p class="small text-muted">Garantizamos el mejor precio</p>
        </div>
        <div class="col-md-3 mb-4">
          <i class="fas fa-car fa-2x mb-3"></i>
          <h٦>Autos y más</h٦>
          <p class="small text-muted">Alquiler de autos y otros servicios</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer -->
  <footer class="footer-section bg-dark text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h5>Frategar</h5>
          <ul class="list-unstyled small">
            <li>Quiénes somos</li>
            <li>Trabaja con nosotros</li>
            <li>Prensa</li>
            <li>Inversores</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5>Productos</h5>
          <ul class="list-unstyled small">
            <li>Vuelos</li>
            <li>Hoteles</li>
            <li>Paquetes</li>
            <li>Autos</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5>Ayuda</h5>
          <ul class="list-unstyled small">
            <li>Centro de ayuda</li>
            <li>Contacto</li>
            <li>>Términos y condiciones</li>
            <li>Privacidad</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5>Síguenos</h5>
          <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <hr class="bg-secondary mt-4">
      <div class="row">
        <div class="col text-center">
          <small>&copy; 2025 Frategar. Todos los derechos reservados.</small>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
