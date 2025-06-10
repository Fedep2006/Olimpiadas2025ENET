<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda - Frategar</title>
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
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--despegar-blue) !important;
        }
        
        .search-header {
            background: linear-gradient(135deg, var(--despegar-blue) 0%, #004499 100%);
            color: white;
            padding: 20px 0;
        }
        
        .search-form-compact {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .search-input {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.9rem;
        }
        
        .search-input:focus {
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }
        
        .btn-search {
            background-color: var(--despegar-orange);
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: bold;
            color: white;
        }
        
        .btn-search:hover {
            background-color: #e55a00;
            color: white;
        }
        
        .filters-sidebar {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        
        .filter-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .filter-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .filter-title {
            font-weight: bold;
            color: var(--despegar-blue);
            margin-bottom: 15px;
            font-size: 1rem;
        }
        
        .filter-option {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 8px 0;
        }
        
        .filter-option input[type="checkbox"] {
            margin-right: 10px;
            accent-color: var(--despegar-blue);
        }
        
        .filter-count {
            color: #6c757d;
            font-size: 0.85rem;
        }
        
        .price-range {
            margin: 15px 0;
        }
        
        .price-inputs {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .price-input {
            width: 80px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            text-align: center;
        }
        
        .results-header {
            background: white;
            border-radius: 15px;
            padding: 20px 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .results-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .results-count {
            color: var(--despegar-blue);
            font-weight: bold;
        }
        
        .sort-options {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .sort-select {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 8px 12px;
            background: white;
        }
        
        .view-toggle {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .view-btn {
            padding: 8px 12px;
            border: none;
            background: white;
            color: #6c757d;
            cursor: pointer;
        }
        
        .view-btn.active {
            background: var(--despegar-blue);
            color: white;
        }
        
        .flight-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .flight-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            border-left-color: var(--despegar-blue);
        }
        
        .flight-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 20px;
        }
        
        .airline-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .airline-logo {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: var(--despegar-light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
        }
        
        .airline-details h6 {
            margin: 0;
            color: var(--despegar-blue);
            font-weight: bold;
        }
        
        .flight-price {
            text-align: right;
        }
        
        .price-amount {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--despegar-orange);
            margin: 0;
        }
        
        .price-per-person {
            font-size: 0.85rem;
            color: #6c757d;
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
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--despegar-blue);
        }
        
        .airport-time {
            font-size: 1.1rem;
            font-weight: bold;
            margin: 5px 0;
        }
        
        .airport-name {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .flight-path {
            flex: 2;
            position: relative;
            margin: 0 30px;
            text-align: center;
        }
        
        .flight-line {
            height: 2px;
            background: linear-gradient(to right, var(--despegar-blue), var(--despegar-orange));
            position: relative;
            margin: 10px 0;
        }
        
        .flight-duration {
            background: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.85rem;
            color: var(--despegar-blue);
            font-weight: bold;
            border: 2px solid var(--despegar-light-blue);
        }
        
        .flight-type {
            font-size: 0.8rem;
            color: #28a745;
            margin-top: 5px;
        }
        
        .flight-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        
        .flight-features {
            display: flex;
            gap: 20px;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .feature-item i {
            color: var(--despegar-blue);
        }
        
        .flight-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-select {
            background-color: var(--despegar-blue);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .btn-select:hover {
            background-color: #0052a3;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-details {
            background: transparent;
            border: 2px solid var(--despegar-blue);
            color: var(--despegar-blue);
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .btn-details:hover {
            background: var(--despegar-blue);
            color: white;
        }
        
        .offer-badge {
            background: linear-gradient(135deg, var(--despegar-orange), #ff8533);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: bold;
            position: absolute;
            top: 15px;
            right: 15px;
        }
        
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        
        .pagination .page-link {
            color: var(--despegar-blue);
            border-color: #dee2e6;
            padding: 10px 15px;
        }
        
        .pagination .page-link:hover {
            background-color: var(--despegar-light-blue);
            border-color: var(--despegar-blue);
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--despegar-blue);
            border-color: var(--despegar-blue);
        }
        
        .no-results {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .no-results i {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }
        
        .loading-spinner {
            text-align: center;
            padding: 40px;
        }
        
        .spinner-border {
            color: var(--despegar-blue);
        }
        
        .footer-section {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            margin-top: 50px;
        }
        
        @media (max-width: 768px) {
            .filters-sidebar {
                position: static;
                margin-bottom: 20px;
            }
            
            .flight-route {
                flex-direction: column;
                gap: 15px;
            }
            
            .flight-path {
                margin: 0;
                order: -1;
            }
            
            .flight-line {
                width: 2px;
                height: 50px;
                background: linear-gradient(to bottom, var(--despegar-blue), var(--despegar-orange));
            }
            
            .flight-details {
                flex-direction: column;
                gap: 15px;
                align-items: start;
            }
            
            .flight-actions {
                width: 100%;
                justify-content: space-between;
            }
        }
        
        .filter-clear {
            color: var(--despegar-orange);
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
        }
        
        .filter-clear:hover {
            color: #e55a00;
            text-decoration: underline;
        }
        
        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .filter-tag {
            background: var(--despegar-light-blue);
            color: var(--despegar-blue);
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .filter-tag .remove {
            cursor: pointer;
            font-weight: bold;
        }
        
        .compare-checkbox {
            position: absolute;
            top: 15px;
            left: 15px;
        }
        
        .compare-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--despegar-blue);
            color: white;
            padding: 15px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }
        
        .compare-bar.show {
            transform: translateY(0);
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
                        <a class="nav-link active" href="#"><i class="fas fa-plane"></i> Vuelos</a>
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

    <!-- Search Header -->
    <section class="search-header">
        <div class="container">
            <div class="search-form-compact">
                <div class="row align-items-end">
                    <div class="col-md-2">
                        <label class="form-label">Origen</label>
                        <input type="text" class="form-control search-input" value="Buenos Aires (EZE)" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Destino</label>
                        <input type="text" class="form-control search-input" value="Miami (MIA)" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Salida</label>
                        <input type="date" class="form-control search-input" value="2024-03-15">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Regreso</label>
                        <input type="date" class="form-control search-input" value="2024-03-22">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Pasajeros</label>
                        <select class="form-control search-input">
                            <option>2 Adultos</option>
                            <option>1 Adulto</option>
                            <option>3 Adultos</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-search w-100">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-4">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3">
                <div class="filters-sidebar">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="filter-title mb-0">Filtros</h5>
                        <a href="#" class="filter-clear" onclick="clearAllFilters()">Limpiar todo</a>
                    </div>
                    
                    <!-- Active Filters -->
                    <div class="active-filters" id="activeFilters">
                        <!-- Active filter tags will be added here -->
                    </div>
                    
                    <!-- Price Range -->
                    <div class="filter-section">
                        <div class="filter-title">Precio por persona</div>
                        <div class="price-range">
                            <div class="price-inputs">
                                <input type="number" class="price-input" placeholder="Min" value="500">
                                <span>-</span>
                                <input type="number" class="price-input" placeholder="Max" value="2000">
                            </div>
                            <input type="range" class="form-range mt-3" min="0" max="3000" value="1500">
                        </div>
                    </div>
                    
                    <!-- Airlines -->
                    <div class="filter-section">
                        <div class="filter-title">Aerolíneas</div>
                        <div class="filter-option">
                            <input type="checkbox" id="american" checked>
                            <label for="american">American Airlines</label>
                            <span class="filter-count ms-auto">12</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="latam">
                            <label for="latam">LATAM</label>
                            <span class="filter-count ms-auto">8</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="aerolineas">
                            <label for="aerolineas">Aerolíneas Argentinas</label>
                            <span class="filter-count ms-auto">6</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="united">
                            <label for="united">United Airlines</label>
                            <span class="filter-count ms-auto">4</span>
                        </div>
                    </div>
                    
                    <!-- Stops -->
                    <div class="filter-section">
                        <div class="filter-title">Escalas</div>
                        <div class="filter-option">
                            <input type="checkbox" id="direct" checked>
                            <label for="direct">Vuelo directo</label>
                            <span class="filter-count ms-auto">15</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="one-stop">
                            <label for="one-stop">1 escala</label>
                            <span class="filter-count ms-auto">18</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="two-stops">
                            <label for="two-stops">2+ escalas</label>
                            <span class="filter-count ms-auto">7</span>
                        </div>
                    </div>
                    
                    <!-- Departure Time -->
                    <div class="filter-section">
                        <div class="filter-title">Horario de salida</div>
                        <div class="filter-option">
                            <input type="checkbox" id="morning">
                            <label for="morning">Mañana (06:00 - 12:00)</label>
                            <span class="filter-count ms-auto">12</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="afternoon">
                            <label for="afternoon">Tarde (12:00 - 18:00)</label>
                            <span class="filter-count ms-auto">15</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="evening">
                            <label for="evening">Noche (18:00 - 24:00)</label>
                            <span class="filter-count ms-auto">8</span>
                        </div>
                    </div>
                    
                    <!-- Duration -->
                    <div class="filter-section">
                        <div class="filter-title">Duración del vuelo</div>
                        <div class="filter-option">
                            <input type="checkbox" id="short">
                            <label for="short">Menos de 8 horas</label>
                            <span class="filter-count ms-auto">10</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="medium">
                            <label for="medium">8 - 12 horas</label>
                            <span class="filter-count ms-auto">20</span>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="long">
                            <label for="long">Más de 12 horas</label>
                            <span class="filter-count ms-auto">10</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Results -->
            <div class="col-lg-9">
                <!-- Results Header -->
                <div class="results-header">
                    <div class="results-info">
                        <div>
                            <span class="results-count">40 vuelos encontrados</span>
                            <span class="text-muted">para Buenos Aires - Miami</span>
                        </div>
                        
                        <div class="sort-options">
                            <span class="text-muted me-2">Ordenar por:</span>
                            <select class="sort-select" onchange="sortResults(this.value)">
                                <option value="price">Menor precio</option>
                                <option value="duration">Menor duración</option>
                                <option value="departure">Horario de salida</option>
                                <option value="airline">Aerolínea</option>
                            </select>
                            
                            <div class="view-toggle">
                                <button class="view-btn active" onclick="toggleView('list')">
                                    <i class="fas fa-list"></i>
                                </button>
                                <button class="view-btn" onclick="toggleView('grid')">
                                    <i class="fas fa-th"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Flight Results -->
                <div id="flightResults">
                    <!-- Flight Card 1 -->
                    <div class="flight-card">
                        <div class="offer-badge">¡OFERTA!</div>
                        <input type="checkbox" class="compare-checkbox" onchange="toggleCompare(this, '1')">
                        
                        <div class="flight-header">
                            <div class="airline-info">
                                <div class="airline-logo">
                                    <i class="fas fa-plane fa-lg"></i>
                                </div>
                                <div class="airline-details">
                                    <h6>American Airlines</h6>
                                    <small class="text-muted">AA 1205 • Boeing 777-300ER</small>
                                </div>
                            </div>
                            
                            <div class="flight-price">
                                <div class="price-amount">$899</div>
                                <div class="price-per-person">por persona</div>
                            </div>
                        </div>
                        
                        <div class="flight-route">
                            <div class="airport-info">
                                <div class="airport-code">EZE</div>
                                <div class="airport-time">08:30</div>
                                <div class="airport-name">Buenos Aires</div>
                            </div>
                            
                            <div class="flight-path">
                                <div class="flight-duration">8h 45m</div>
                                <div class="flight-line"></div>
                                <div class="flight-type">Vuelo directo</div>
                            </div>
                            
                            <div class="airport-info">
                                <div class="airport-code">MIA</div>
                                <div class="airport-time">14:15</div>
                                <div class="airport-name">Miami</div>
                            </div>
                        </div>
                        
                        <div class="flight-details">
                            <div class="flight-features">
                                <div class="feature-item">
                                    <i class="fas fa-suitcase"></i>
                                    <span>Equipaje incluido</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-wifi"></i>
                                    <span>WiFi gratis</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>Comida incluida</span>
                                </div>
                            </div>
                            
                            <div class="flight-actions">
                                <button class="btn btn-details" onclick="showDetails('1')">Ver detalles</button>
                                <button class="btn btn-select" onclick="selectFlight('1')">Seleccionar</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Flight Card 2 -->
                    <div class="flight-card">
                        <input type="checkbox" class="compare-checkbox" onchange="toggleCompare(this, '2')">
                        
                        <div class="flight-header">
                            <div class="airline-info">
                                <div class="airline-logo">
                                    <i class="fas fa-plane fa-lg"></i>
                                </div>
                                <div class="airline-details">
                                    <h6>LATAM Airlines</h6>
                                    <small class="text-muted">LA 533 • Airbus A350-900</small>
                                </div>
                            </div>
                            
                            <div class="flight-price">
                                <div class="price-amount">$1,150</div>
                                <div class="price-per-person">por persona</div>
                            </div>
                        </div>
                        
                        <div class="flight-route">
                            <div class="airport-info">
                                <div class="airport-code">EZE</div>
                                <div class="airport-time">14:20</div>
                                <div class="airport-name">Buenos Aires</div>
                            </div>
                            
                            <div class="flight-path">
                                <div class="flight-duration">9h 15m</div>
                                <div class="flight-line"></div>
                                <div class="flight-type">Vuelo directo</div>
                            </div>
                            
                            <div class="airport-info">
                                <div class="airport-code">MIA</div>
                                <div class="airport-time">20:35</div>
                                <div class="airport-name">Miami</div>
                            </div>
                        </div>
                        
                        <div class="flight-details">
                            <div class="flight-features">
                                <div class="feature-item">
                                    <i class="fas fa-suitcase"></i>
                                    <span>Equipaje incluido</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-tv"></i>
                                    <span>Entretenimiento</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-plug"></i>
                                    <span>Toma corriente</span>
                                </div>
                            </div>
                            
                            <div class="flight-actions">
                                <button class="btn btn-details" onclick="showDetails('2')">Ver detalles</button>
                                <button class="btn btn-select" onclick="selectFlight('2')">Seleccionar</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Flight Card 3 -->
                    <div class="flight-card">
                        <input type="checkbox" class="compare-checkbox" onchange="toggleCompare(this, '3')">
                        
                        <div class="flight-header">
                            <div class="airline-info">
                                <div class="airline-logo">
                                    <i class="fas fa-plane fa-lg"></i>
                                </div>
                                <div class="airline-details">
                                    <h6>United Airlines</h6>
                                    <small class="text-muted">UA 845 • Boeing 787-9</small>
                                </div>
                            </div>
                            
                            <div class="flight-price">
                                <div class="price-amount">$1,299</div>
                                <div class="price-per-person">por persona</div>
                            </div>
                        </div>
                        
                        <div class="flight-route">
                            <div class="airport-info">
                                <div class="airport-code">EZE</div>
                                <div class="airport-time">22:45</div>
                                <div class="airport-name">Buenos Aires</div>
                            </div>
                            
                            <div class="flight-path">
                                <div class="flight-duration">12h 30m</div>
                                <div class="flight-line"></div>
                                <div class="flight-type">1 escala en Houston</div>
                            </div>
                            
                            <div class="airport-info">
                                <div class="airport-code">MIA</div>
                                <div class="airport-time">16:15</div>
                                <div class="airport-name">Miami</div>
                            </div>
                        </div>
                        
                        <div class="flight-details">
                            <div class="flight-features">
                                <div class="feature-item">
                                    <i class="fas fa-suitcase"></i>
                                    <span>Equipaje incluido</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-wifi"></i>
                                    <span>WiFi premium</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-glass-water"></i>
                                    <span>Bebidas premium</span>
                                </div>
                            </div>
                            
                            <div class="flight-actions">
                                <button class="btn btn-details" onclick="showDetails('3')">Ver detalles</button>
                                <button class="btn btn-select" onclick="selectFlight('3')">Seleccionar</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Loading Spinner (hidden by default) -->
                    <div class="loading-spinner d-none" id="loadingSpinner">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="mt-3">Buscando más vuelos...</p>
                    </div>
                </div>
                
                <!-- Pagination -->
                <div class="pagination-container">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Anterior</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Compare Bar -->
    <div class="compare-bar" id="compareBar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span id="compareCount">0</span> vuelos seleccionados para comparar
                </div>
                <div>
                    <button class="btn btn-light me-2" onclick="clearCompare()">Limpiar</button>
                    <button class="btn btn-warning" onclick="compareFlights()">Comparar</button>
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