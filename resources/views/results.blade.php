<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Frategar - Resultados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    :root { --primary:#0066cc; --light:#f8f9fa; }
    body { background:var(--light); }
    .navbar-brand { font-weight:700; font-size:1.75rem; color:var(--primary)!important; }
    .hero { position:relative; background:url('/images/hero-bg.jpg') center/cover no-repeat; height:300px; }
    .search-card { position:absolute; left:50%; bottom:-30px; transform:translateX(-50%); width:90%; max-width:800px; background:#fff; border-radius:12px; box-shadow:0 4px 20px rgba(0,0,0,0.1); padding:1rem; }
    .results-section { padding-top:60px; }
    .result-card { background:#fff; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.05); margin-bottom:1rem; transition:transform .2s; }
    .result-card:hover { transform:translateY(-2px); }
    .result-body { padding:1rem; display:flex; justify-content:space-between; align-items:center; }
    .result-info { flex:1; }
    .badge-type { background:var(--primary); text-transform:uppercase; font-size:.75rem; }
    .item-price { font-size:1.1rem; font-weight:600; }
    .footer-section { background:#2c3e50; color:#fff; padding:2rem 0; }
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
    </div>
  </nav>

  @php
    $hasFilters = request()->hasAny(['origin','destination','checkin','checkout','guests','price_min','price_max']);
  @endphp

  <!-- Hero + Filters -->
  <section class="hero">
    <div class="search-card">
      <h5 class="mb-3">Filtros de búsqueda</h5>
      <form action="{{ route('results.index') }}" method="GET">
        <div class="row g-2">
          <div class="col-md-3"><input type="text" name="origin" class="form-control" placeholder="Origen" value="{{ request('origin') }}"></div>
          <div class="col-md-3"><input type="text" name="destination" class="form-control" placeholder="Destino" value="{{ request('destination') }}"></div>
          <div class="col-md-2"><input type="date" name="checkin" class="form-control" value="{{ request('checkin') }}"></div>
          <div class="col-md-2"><input type="date" name="checkout" class="form-control" value="{{ request('checkout') }}"></div>
          <div class="col-md-2"><input type="number" name="guests" min="1" class="form-control" value="{{ request('guests',1) }}" placeholder="Huéspedes"></div>
        </div>
        <div class="row g-2 mt-3">
          <div class="col-md-3"><input type="number" name="price_min" class="form-control" placeholder="Precio mín." value="{{ request('price_min') }}"></div>
          <div class="col-md-3"><input type="number" name="price_max" class="form-control" placeholder="Precio máx." value="{{ request('price_max') }}"></div>
          <div class="col-md-6 text-end"><button class="btn btn-primary"><i class="fas fa-filter me-1"></i> Aplicar filtros</button></div>
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

    <ul class="nav nav-tabs mb-4">
      <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-all">Todos ({{ $totalAll }})</button></li>
      @foreach($tabs as $key=>$label)
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-{{ $key }}">{{ $label }} ({{ $results[$key]->count() }})</button></li>
      @endforeach
    </ul>

    <div class="tab-content">
      <div class="tab-pane fade show active" id="tab-all">
        @forelse(collect($results)->flatten(1) as $item)
          @php
            $type = $item instanceof \App\Models\Viaje ? 'viajes'
                  : ($item instanceof \App\Models\Hospedaje ? 'hospedajes'
                  : ($item instanceof \App\Models\Vehiculo ? 'vehiculos' : 'paquetes'));
          @endphp
          <div class="result-card">
            <a href="{{ url('/details', ['type'=>$type,'id'=>$item->id]) }}" class="text-decoration-none text-dark">
              <div class="result-body">
                <div class="result-info">
                  <span class="badge bg-primary badge-type">{{ strtoupper($type) }}</span>
                  <div class="fw-semibold mt-1">
                    @if($type=='viajes')
                      {{ $item->nombre }} ({{ $item->origen }} → {{ $item->destino }})
                    @elseif($type=='vehiculos')
                      {{ $item->marca }} {{ $item->modelo }}
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
          <p class="text-center text-muted">No hay resultados.</p>
        @endforelse
      </div>
      @foreach($tabs as $key=>$label)
        <div class="tab-pane fade" id="tab-{{ $key }}">
          @forelse($results[$key] as $item)
            @php $type = $key; @endphp
            <div class="result-card">
              <a href="{{ url('/details', ['type'=>$type,'id'=>$item->id]) }}" class="text-decoration-none text-dark">
                <div class="result-body">
                  <div class="result-info">
                    <span class="badge bg-primary badge-type">{{ strtoupper($type) }}</span>
                    <div class="fw-semibold mt-1">
                      @if($type=='viajes')
                        {{ $item->nombre }} ({{ $item->origen }} → {{ $item->destino }})
                      @elseif($type=='vehiculos')
                        {{ $item->marca }} {{ $item->modelo }}
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
      <a href="/" class="btn btn-outline-primary">← Volver al inicio</a>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
