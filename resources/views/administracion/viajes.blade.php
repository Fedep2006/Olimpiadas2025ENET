<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Viajes</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- Configuración global de AJAX -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--despegar-blue) 0%, #004499 100%);
            color: white;
            z-index: 1000;
            overflow-y: auto;
            transition: left 0.3s ease;
        }

        .admin-sidebar.show {
            left: 0;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: block;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--despegar-orange);
        }

        .menu-item i {
            width: 20px;
            margin-right: 10px;
        }

        .menu-item[type="submit"] {
            background: none;
            border: none;
            border-left: 3px solid transparent;
            box-shadow: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font: inherit;
        }

        .main-content {
            margin-left: 0;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-width);
        }

        .top-navbar {
            background-color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h4 {
            margin: 0;
            color: #333;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: var(--despegar-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .dashboard-content {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #666;
            margin: 0;
        }

        .btn-admin {
            background-color: var(--despegar-blue);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-admin:hover {
            background-color: #004499;
            color: white;
        }

        .btn-admin.orange {
            background-color: var(--despegar-orange);
        }

        .btn-admin.orange:hover {
            background-color: #cc5200;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--despegar-blue);
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        .imagen-viaje {
            width: 100px;
            height: 100px;
            object-fit: cover;
            object-position: center;
            border-radius: 5px;
        }

        .imagen-preview {
            width: 200px;
            height: 200px;
            object-fit: cover;
            object-position: center;
            border-radius: 5px;
        }

        .imagen-detalle {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 10px;
        }

        .table {
            margin-top: 20px;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .filtros-sidebar {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 5px;
            margin: 20px;
        }

        .filtros-sidebar h5 {
            color: white;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .filtros-sidebar .form-label {
            color: white;
            font-weight: 500;
        }

        .filtros-sidebar .form-control,
        .filtros-sidebar .form-select {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .filtros-sidebar .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .filtros-sidebar .form-control:focus,
        .filtros-sidebar .form-select:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .filtros-sidebar .btn {
            width: 100%;
            margin-top: 10px;
            background-color: var(--despegar-orange);
            border: none;
        }

        .filtros-sidebar .btn-secondary {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .filtros-sidebar .btn:hover {
            opacity: 0.9;
        }

        /* Estilos para los filtros horizontales */
        .filtros-horizontales {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .filtros-horizontales .row {
            align-items: flex-end;
        }

        .filtros-horizontales .form-label {
            color: #333;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .filtros-horizontales .form-control,
        .filtros-horizontales .form-select {
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filtros-horizontales .btn {
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .filtros-horizontales .btn-primary {
            background-color: var(--despegar-blue);
            border: none;
        }

        .filtros-horizontales .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        /* Estilos para el modal de detalles */
        .detalles-viaje {
            padding: 20px;
        }

        .detalles-viaje .imagen-principal {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .detalles-viaje .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .detalles-viaje .info-item {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .detalles-viaje .info-label {
            font-weight: 600;
            color: #666;
            margin-bottom: 5px;
        }

        .detalles-viaje .info-value {
            color: #333;
            font-size: 1.1em;
        }

        .detalles-viaje .descripcion {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .detalles-viaje .descripcion h5 {
            color: #333;
            margin-bottom: 10px;
        }

        .detalles-viaje .descripcion p {
            color: #666;
            margin: 0;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            color: var(--despegar-blue);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0;
            margin-right: 15px;
        }

        .toggle-sidebar:hover {
            color: var(--despegar-orange);
        }

        /* Estilos para los selects múltiples */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            padding: 4px;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
            background-color: var(--despegar-blue);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 2px 8px;
            margin: 2px;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            margin-right: 4px;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ffebee;
        }

        /* Estilos para los badges de estado */
        .badge {
            padding: 6px 12px;
            font-weight: 500;
            border-radius: 4px;
        }

        .badge.bg-success {
            background-color: #28a745 !important;
        }

        .badge.bg-danger {
            background-color: #dc3545 !important;
        }

        .badge.bg-primary {
            background-color: var(--despegar-blue) !important;
        }

        .badge.bg-info {
            background-color: #17a2b8 !important;
        }

        .badge.bg-warning {
            background-color: #ffc107 !important;
            color: #212529;
        }

        .badge.bg-secondary {
            background-color: #6c757d !important;
        }

        /* Estilos para la tabla */
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .action-btn.btn-edit {
            background-color: var(--despegar-blue);
            color: white;
        }

        .action-btn.btn-edit:hover {
            background-color: #004499;
        }

        .action-btn.btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .action-btn.btn-delete:hover {
            background-color: #c82333;
        }

        /* Estilos para el formulario */
        .form-label {
            font-weight: 500;
            color: #495057;
        }

        .form-control:focus {
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .form-check-input:checked {
            background-color: var(--despegar-blue);
            border-color: var(--despegar-blue);
        }

        .select2-container {
            width: 100% !important;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/administracion" class="sidebar-brand">
                <i class="fas fa-plane me-2"></i>
                <span class="brand-text">Frategar Admin</span>
            </a>
        </div>
        <nav class="sidebar-menu">
            <a href="/administracion" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span class="menu-text">Inicio</span>
            </a>
            <a href="/administracion/reservas" class="menu-item">
                <i class="fas fa-calendar-check"></i>
                <span class="menu-text">Reservas</span>
            </a>
            <a href="/administracion/usuarios" class="menu-item">
                <i class="fas fa-users"></i>
                <span class="menu-text">Usuarios</span>
            </a>
            <a href="/administracion/viajes" class="menu-item active">
                <i class="fas fa-plane"></i>
                <span class="menu-text">Viajes</span>
            </a>
            <a href="/administracion/hoteles" class="menu-item">
                <i class="fas fa-bed"></i>
                <span class="menu-text">Hospedaje</span>
            </a>
            <a href="/administracion/vehiculos" class="menu-item">
                <i class="fas fa-car"></i>
                <span class="menu-text">Vehículos</span>
            </a>
            <a href="/administracion/paquetes" class="menu-item">
                <i class="fas fa-tags"></i>
                <span class="menu-text">Paquetes</span>
            </a>
            <a href="/administracion/empleados" class="menu-item">
                <i class="fas fa-users"></i>
                <span class="menu-text">Empleados</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="menu-text">Cerrar Sesión</span>
                </button>
            </form>
        </nav>
    </div>
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar">
    <div class="admin-header d-flex justify-content-between align-items-center w-100">
        <div class="d-flex align-items-center">
            <button class="toggle-sidebar" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h4 class="mb-0 ms-2">Panel Administrativo</h4>
        </div>
        <div class="admin-user d-flex align-items-center">
            <div class="user-avatar">{{ substr(Auth::user()->name, 0, 2) }}</div>
            <div class="ms-2">
                <div class="fw-bold">{{ Auth::user()->name }}</div>
                <small class="text-muted">{{ Auth::user()->role }}</small>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none p-0 ms-2">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">Gestión de Viajes</h1>
                        <p class="page-subtitle">Administra todos los viajes disponibles</p>
                    </div>
                    <button type="button" class="btn-admin orange" data-bs-toggle="modal" data-bs-target="#viajeModal">
                        <i class="fas fa-plus"></i>
                        Nuevo Viaje
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-number">{{ $viajes->count() }}</div>
                    <div class="stat-label">Total Viajes</div>
                </div>
                <div class="stat-card" style="border-left-color: #28a745;">
                    <div class="stat-number">{{ $viajes->where('tipo', 'aereo')->count() }}</div>
                    <div class="stat-label">Viajes Aéreos</div>
                </div>
                <div class="stat-card" style="border-left-color: #ffc107;">
                    <div class="stat-number">{{ $viajes->where('tipo', 'terrestre')->count() }}</div>
                    <div class="stat-label">Viajes Terrestres</div>
                </div>
                <div class="stat-card" style="border-left-color: #dc3545;">
                    <div class="stat-number">{{ $viajes->where('tipo', 'maritimo')->count() }}</div>
                    <div class="stat-label">Viajes Marítimos</div>
                </div>
            </div>

            <!-- Filtros horizontales -->
            <div class="filtros-horizontales">
                <form id="filtroForm" method="GET" action="{{ url()->current() }}" class="mb-2">

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="searchText" class="form-label">Buscar</label>
                            <input type="text" class="form-control" id="searchText" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="tipoViaje" class="form-label">Tipo de Viaje</label>
                            <select class="form-select" id="tipoViaje" name="tipo">
    <option value="">Todos</option>
    <option value="Nacional" {{ request('tipo') == 'Nacional' ? 'selected' : '' }}>Nacional</option>
    <option value="Internacional" {{ request('tipo') == 'Internacional' ? 'selected' : '' }}>Internacional</option>
</select>
                        </div>
                        <div class="col-md-2">
                            <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="fechaFin" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" id="fechaFin" name="fecha_fin" value="{{ request('fecha_fin') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="filtroPrecio" class="form-label">Rango de Precio</label>
                            <select class="form-select" id="filtroPrecio" name="precio">
    <option value="">Todos</option>
    <option value="0-1000" {{ request('precio') == '0-1000' ? 'selected' : '' }}>$0 - $1,000</option>
    <option value="1000-5000" {{ request('precio') == '1000-5000' ? 'selected' : '' }}>$1,000 - $5,000</option>
    <option value="5000+" {{ request('precio') == '5000+' ? 'selected' : '' }}>$5,000+</option>
</select>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="reset" class="btn btn-secondary w-100" id="btnLimpiarFiltros">
    <i class="fas fa-times"></i> Limpiar
</button>
                        </div>
    <div class="col-md-1 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-search"></i> Buscar
        </button>
    </div>
</div>
</form>
            </div>

            <!-- Vista de tarjetas de viajes -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
    @foreach($viajes as $viaje)
    <div class="col">
        <div class="card h-100 shadow-sm viaje-card" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#modalViajeDetalle{{ $viaje->id }}">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="badge bg-{{ $viaje->activo ? 'success' : 'danger' }}">{{ $viaje->activo ? 'Activo' : 'Inactivo' }}</span>
                    <span class="badge bg-info">{{ $viaje->tipo }}</span>
                </div>
                <h5 class="card-title mb-1">{{ $viaje->nombre }}</h5>
                <p class="mb-1"><strong>Empresa:</strong> {{ $viaje->empresa }}</p>
                <p class="mb-1"><strong>Origen:</strong> {{ $viaje->origen }} <br> <strong>Destino:</strong> {{ $viaje->destino }}</p>
                <p class="mb-1"><strong>Salida:</strong> {{ $viaje->fecha_salida->format('d/m/Y H:i') }}</p>
                <p class="mb-1"><strong>Llegada:</strong> {{ $viaje->fecha_llegada->format('d/m/Y H:i') }}</p>
                <p class="mb-1"><strong>Precio:</strong> ${{ number_format($viaje->precio_base, 2) }}</p>
            </div>
        </div>
    </div>

    <!-- Modal de detalles del viaje -->
    <div class="modal fade" id="modalViajeDetalle{{ $viaje->id }}" tabindex="-1" aria-labelledby="modalViajeDetalleLabel{{ $viaje->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalViajeDetalleLabel{{ $viaje->id }}">Detalle del Viaje: {{ $viaje->nombre }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Tipo:</strong> {{ $viaje->tipo }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Estado:</strong> <span class="badge bg-{{ $viaje->activo ? 'success' : 'danger' }}">{{ $viaje->activo ? 'Activo' : 'Inactivo' }}</span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Origen:</strong> {{ $viaje->origen }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Destino:</strong> {{ $viaje->destino }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Fecha de Salida:</strong> {{ $viaje->fecha_salida->format('d/m/Y H:i') }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Fecha de Llegada:</strong> {{ $viaje->fecha_llegada->format('d/m/Y H:i') }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Empresa:</strong> {{ $viaje->empresa }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Número de Viaje:</strong> {{ $viaje->numero_viaje }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Capacidad Total:</strong> {{ $viaje->capacidad_total }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Asientos Disponibles:</strong> {{ $viaje->asientos_disponibles }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Precio Base:</strong> ${{ number_format($viaje->precio_base, 2) }}
                        </div>
                        <div class="col-md-12 mb-2">
                            <strong>Descripción:</strong> {{ $viaje->descripcion ?? '-' }}
                        </div>
                        <div class="col-md-12 mb-2">
                            <strong>Observaciones:</strong> {{ $viaje->observaciones ?? '-' }}
                        </div>
                        <div class="col-md-12 mb-2">
                            <strong>Clases:</strong> 
                            @php $clasesViaje = is_array($viaje->clases) ? $viaje->clases : (json_decode($viaje->clases, true) ?: []); @endphp
                            @if(count($clasesViaje))
                                {{ implode(', ', $clasesViaje) }}
                            @else
                                -
                            @endif
                        </div>
                        <div class="col-md-12 mb-2">
                            <strong>Servicios:</strong> 
                            @php $serviciosViaje = is_array($viaje->servicios) ? $viaje->servicios : (json_decode($viaje->servicios, true) ?: []); @endphp
                            @if(count($serviciosViaje))
                                {{ implode(', ', $serviciosViaje) }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

        </div>
    </div>

    <!-- Modal para crear/editar viaje -->
    <div class="modal fade" id="viajeModal" tabindex="-1" aria-labelledby="viajeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viajeModalLabel">Nuevo Viaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="viajeForm">
                        @csrf
                        <input type="hidden" name="_method" id="method" value="POST">
                        <input type="hidden" name="id" id="viaje_id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre *</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo *</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
    <option value="">Seleccione un tipo</option>
    @foreach($tipos as $key => $label)
        <option value="{{ $key }}">{{ $label }}</option>
    @endforeach
</select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="origen" class="form-label">Origen *</label>
                                    <input type="text" class="form-control" id="origen" name="origen" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="destino" class="form-label">Destino *</label>
                                    <input type="text" class="form-control" id="destino" name="destino" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fecha_salida" class="form-label">Fecha Salida *</label>
                                    <input type="datetime-local" class="form-control" id="fecha_salida" name="fecha_salida" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fecha_llegada" class="form-label">Fecha Llegada *</label>
                                    <input type="datetime-local" class="form-control" id="fecha_llegada" name="fecha_llegada" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="empresa" class="form-label">Empresa *</label>
                                    <input type="text" class="form-control" id="empresa" name="empresa" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="numero_viaje" class="form-label">Número de Viaje *</label>
                                    <input type="text" class="form-control" id="numero_viaje" name="numero_viaje" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="capacidad_total" class="form-label">Capacidad Total *</label>
                                    <input type="number" class="form-control" id="capacidad_total" name="capacidad_total" required min="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="asientos_disponibles" class="form-label">Asientos Disponibles *</label>
                                    <input type="number" class="form-control" id="asientos_disponibles" name="asientos_disponibles" required min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="precio_base" class="form-label">Precio Base *</label>
                                    <input type="number" class="form-control" id="precio_base" name="precio_base" required min="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="clases" class="form-label">Clases Disponibles *</label>
                                    <div class="mb-3">
    <label class="form-label">Clases Disponibles *</label>
    <div>
        @foreach($clases as $clase)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="clases[]" id="clase_{{ $clase['id'] }}" value="{{ $clase['id'] }}">
                <label class="form-check-label" for="clase_{{ $clase['id'] }}">{{ $clase['nombre'] }}</label>
            </div>
        @endforeach
    </div>
</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="servicios" class="form-label">Servicios Incluidos *</label>
                                    <div class="mb-3">
    <label class="form-label">Servicios Incluidos *</label>
    <div>
        @foreach($servicios as $servicio)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="servicios[]" id="servicio_{{ $servicio['id'] }}" value="{{ $servicio['id'] }}">
                <label class="form-check-label" for="servicio_{{ $servicio['id'] }}">{{ $servicio['nombre'] }}</label>
            </div>
        @endforeach
    </div>
</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="activo" class="form-label">Estado</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" checked>
                                        <label class="form-check-label" for="activo">Activo</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción *</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="observaciones" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="observaciones" name="observaciones" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="guardarViajeBtn" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver detalles -->
    <div class="modal fade" id="detallesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles del Viaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="detalles-viaje">
                        <div id="imagenDetalle" class="text-center">
                            <img src="" alt="Imagen del viaje" class="imagen-principal">
                        </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Tipo de Viaje</div>
                                <div class="info-value" id="detalleTipo"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Origen</div>
                                <div class="info-value" id="detalleOrigen"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Destino</div>
                                <div class="info-value" id="detalleDestino"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Precio</div>
                                <div class="info-value" id="detallePrecio"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Fecha de Salida</div>
                                <div class="info-value" id="detalleFechaSalida"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Fecha de Llegada</div>
                                <div class="info-value" id="detalleFechaLlegada"></div>
                            </div>
                        </div>
                        <div class="descripcion">
                            <h5>Descripción</h5>
                            <p id="detalleDescripcion"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Manejador del botón guardar
    $(document).on('click', '#guardarViajeBtn', function(e) {
        e.preventDefault();
        guardarViaje();
    });

    // Manejador del envío del formulario
    $('#viajeForm').on('submit', function(e) {
        e.preventDefault();
        guardarViaje();
    });

    $(document).ready(function() {
        // Inicializar Select2
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });



        // Cuando abres el modal para CREAR un nuevo viaje
        $('#viajeModal').on('show.bs.modal', function(e) {
            // Si el disparador NO tiene data-id, es creación
            if (!$(e.relatedTarget).data('id')) {
                $('#viajeForm')[0].reset();
                $('#viajeForm').attr('action', '/administracion/viajes');
                $('#viajeForm input[name="_method"]').val('POST');
                $('#viajeModalLabel').text('Nuevo Viaje');
                
                // Inicializar selects múltiples
                $('.select2').select2({
                    theme: 'bootstrap4',
                    width: '100%'
                });
            }
        });

        // Evento click para los botones de editar
        $(document).on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            
            // Mostrar modal
            const $modal = $('#viajeModal');
            
            // Resetear el formulario
            const $form = $('#viajeForm');
            $form[0].reset();
            
            // Configurar para edición
            $modal.find('.modal-title').text('Editar Viaje');
            $form.attr('action', `/administracion/viajes/${id}`);
            $form.find('input[name="_method"]').val('PUT');
            
            // Mostrar el modal
            $modal.modal('show');
            
            // Mostrar loading en el botón de guardar
            const $submitBtn = $form.find('button[type="submit"]');
            const originalBtnText = $submitBtn.html();
            $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...');
            
            // Traer datos del viaje
            $.ajax({
                url: `/administracion/viajes/${id}/edit`,
                method: 'GET',
                success: function(viaje) {
                    try {
                        // Rellenar inputs básicos
                        $('#viaje_id').val(viaje.id);
                        $('#nombre').val(viaje.nombre);
                        $('#tipo').val(viaje.tipo).trigger('change');
                        $('#origen').val(viaje.origen).trigger('change');
                        $('#destino').val(viaje.destino).trigger('change');
                        $('#fecha_salida').val(viaje.fecha_salida);
                        $('#fecha_llegada').val(viaje.fecha_llegada);
                        $('#empresa').val(viaje.empresa);
                        $('#numero_viaje').val(viaje.numero_viaje);
                        $('#capacidad_total').val(viaje.capacidad_total);
                        $('#asientos_disponibles').val(viaje.asientos_disponibles);
                        $('#precio_base').val(viaje.precio_base);
                        $('#descripcion').val(viaje.descripcion);
                        $('#observaciones').val(viaje.observaciones);
                        
                        // Checkbox "activo"
                        $('#activo').prop('checked', viaje.activo);
                        
                        // Procesar selects múltiples
                        let clases = [];
                        let servicios = [];
                        // Corregido: usar directamente los arrays si ya lo son
                        if (Array.isArray(viaje.clases)) {
                            clases = viaje.clases;
                        } else if (typeof viaje.clases === 'string') {
                            try {
                                clases = JSON.parse(viaje.clases);
                                if (!Array.isArray(clases)) clases = [];
                            } catch (e) {
                                clases = [];
                            }
                        }
                        if (Array.isArray(viaje.servicios)) {
                            servicios = viaje.servicios;
                        } else if (typeof viaje.servicios === 'string') {
                            try {
                                servicios = JSON.parse(viaje.servicios);
                                if (!Array.isArray(servicios)) servicios = [];
                            } catch (e) {
                                servicios = [];
                            }
                        }
                        
                        // Inicializar selects múltiples
                        const opcionesClases = {!! json_encode(collect($clases)->pluck('nombre', 'id')) !!};
                        const opcionesServicios = {!! json_encode(collect($servicios)->pluck('nombre', 'id')) !!};
                        
                        // Marcar checkboxes de clases
                        $('input[name="clases[]"]').prop('checked', false);
                        clases.forEach(function(id) {
                            $('#clase_' + id).prop('checked', true);
                        });
                        // Marcar checkboxes de servicios
                        $('input[name="servicios[]"]').prop('checked', false);
                        servicios.forEach(function(id) {
                            $('#servicio_' + id).prop('checked', true);
                        });
                        
                    } catch (error) {
                        console.error('Error al procesar los datos del viaje:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al cargar los datos del viaje.',
                            icon: 'error'
                        });
                        $modal.modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar el viaje:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo cargar el viaje. Por favor, inténtelo nuevamente.',
                        icon: 'error'
                    });
                    $modal.modal('hide');
                },
                complete: function() {
                    // Restaurar el botón
                    $submitBtn.prop('disabled', false).html(originalBtnText);
                }
            });
        });
    });

    // Función para guardar viaje
    function guardarViaje() {
        // 1) Obtener el formulario y sus datos
        const $form = $('#viajeForm');
        
        // Crear un objeto para almacenar los datos del formulario
        const formData = {};
        
        // Obtener todos los campos del formulario
        $form.serializeArray().forEach(field => {
            formData[field.name] = field.value;
        });
        
        // Agregar campos especiales
        formData.clases = $('#clases').val() || [];
        formData.servicios = $('#servicios').val() || [];
        formData.activo = $('#activo').is(':checked') ? '1' : '0';
        // Asegurarse de que los arrays se envían como arrays, no como strings
        // No serializar a JSON, solo enviar como array para Laravel
        
        // Verificar que los campos requeridos tengan valor
        const camposRequeridos = ['nombre', 'tipo', 'origen', 'destino', 'fecha_salida', 
                                'fecha_llegada', 'empresa', 'numero_viaje', 'capacidad_total', 
                                'asientos_disponibles', 'precio_base', 'descripcion'];
        
        let faltanCampos = [];
        camposRequeridos.forEach(campo => {
            if (!formData[campo] && formData[campo] !== 0) {
                // Resaltar el campo que falta
                const $campo = $(`[name="${campo}"]`);
                $campo.addClass('is-invalid');
                $campo.after(`<div class="invalid-feedback">Este campo es requerido</div>`);
                faltanCampos.push(campo);
            } else {
                // Remover clases de error si el campo está completo
                const $campo = $(`[name="${campo}"]`);
                $campo.removeClass('is-invalid');
                $campo.next('.invalid-feedback').remove();
            }
        });
        
        if (faltanCampos.length > 0) {
            // Hacer scroll al primer campo con error
            const primerCampo = faltanCampos[0];
            $(`[name="${primerCampo}"]`).get(0).scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            
            // Mostrar mensaje de error
            Swal.fire({
                title: 'Campos requeridos',
                html: `Por favor complete los siguientes campos obligatorios: <br><strong>${faltanCampos.join(', ')}</strong>`,
                icon: 'error'
            });
            return;
        }
        
        // 2) Determinar la URL y el método
        const viajeId = $('#viaje_id').val();
        const url = viajeId ? `/administracion/viajes/${viajeId}` : '/administracion/viajes';
        const method = viajeId ? 'PUT' : 'POST';
        
        // 3) Mostrar loading
        const $submitBtn = $('#guardarViajeBtn');
        const originalBtnText = $submitBtn.html();
        $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...');
        
        // 4) Enviar la petición AJAX
        $.ajax({
            url: url,
            type: method,
            data: JSON.stringify(formData),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: response.message || 'Operación realizada correctamente',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Ocurrió un error al procesar la solicitud',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Error al procesar la solicitud';
                
                if (xhr.status === 422) {
                    // Errores de validación
                    const errors = xhr.responseJSON.errors;
                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('.invalid-feedback').remove();
                    
                    let firstError = '';
                    Object.keys(errors).forEach(field => {
                        const $input = $form.find(`[name="${field}"]`);
                        const $formGroup = $input.closest('.form-group') || $input.parent();
                        $input.addClass('is-invalid');
                        const errorMsg = errors[field][0];
                        $formGroup.append(`<div class="invalid-feedback">${errorMsg}</div>`);
                        
                        // Guardar el primer error para mostrarlo en el alert
                        if (!firstError) firstError = errorMsg;
                    });
                    
                    errorMessage = firstError || 'Por favor, complete todos los campos requeridos';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                Swal.fire({
                    title: 'Error',
                    text: errorMessage,
                    icon: 'error'
                });
                
                // Hacer scroll al primer campo con error
                const $firstError = $form.find('.is-invalid').first();
                if ($firstError.length) {
                    $('html, body').animate({
                        scrollTop: $firstError.offset().top - 100
                    }, 500);
                }
            },
            complete: function() {
                $submitBtn.prop('disabled', false).html(originalBtnText);
            }
        });
    }

    // Función para eliminar viaje
    function eliminarViaje(id) {
        console.log('Eliminando viaje:', id);
        Swal.fire({
            title: '¿Está seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/administracion/viajes/${id}`,
                    method: 'POST',
                    data: { _method: 'DELETE' },
                    success: function(response) {
                        console.log('Respuesta de eliminación:', response);
                        if (response.success) {
                            Swal.fire({
                                title: '¡Eliminado!',
                                text: response.message,
                                icon: 'success'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar:', error);
                        console.error('Detalles del error:', xhr.responseText);
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al eliminar el viaje: ' + (xhr.responseJSON?.message || error),
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }

    function aplicarFiltrosEnTiempoReal() {
        try {
            // Verificar si los elementos existen antes de acceder a sus propiedades
            const searchInput = document.getElementById('searchText');
            const tipoSelect = document.getElementById('tipoViaje');
            const fechaInicioInput = document.getElementById('fechaInicio');
            const fechaFinInput = document.getElementById('fechaFin');
            const precioSelect = document.getElementById('filtroPrecio');
            const contadorElement = document.getElementById('contadorResultados');
            
            // Si algún elemento no existe, salir de la función
            if (!searchInput || !tipoSelect || !fechaInicioInput || !fechaFinInput || !precioSelect || !contadorElement) {
                console.warn('No se encontraron todos los elementos necesarios para aplicar los filtros');
                return;
            }
            
            const searchText = searchInput.value.toLowerCase();
            const tipoViaje = tipoSelect.value;
            const fechaInicio = fechaInicioInput.value;
            const fechaFin = fechaFinInput.value;
            const rangoPrecio = precioSelect.value;

            const filas = document.querySelectorAll('tbody tr');
            let contador = 0;

            filas.forEach(fila => {
                try {
                    const celdas = fila.querySelectorAll('td');
                    // Verificar que la fila tenga suficientes celdas
                    if (celdas.length < 5) return;
                    
                    const destino = celdas[1]?.textContent?.toLowerCase() || '';
                    const tipo = celdas[2]?.textContent || '';
                    const fecha = celdas[3]?.textContent || '';
                    const precioTexto = celdas[4]?.textContent || '0';
                    const precio = parseFloat(precioTexto.replace(/[^0-9.-]+/g, '')) || 0;

                    const cumpleBusqueda = !searchText || destino.includes(searchText);
                    const cumpleTipo = !tipoViaje || tipo === tipoViaje;
                    const cumpleFecha = (!fechaInicio || fecha >= fechaInicio) && 
                                       (!fechaFin || fecha <= fechaFin);
                    
                    let cumplePrecio = true;
                    if (rangoPrecio) {
                        switch(rangoPrecio) {
                            case '0-1000':
                                cumplePrecio = precio >= 0 && precio <= 1000;
                                break;
                            case '1000-5000':
                                cumplePrecio = precio > 1000 && precio <= 5000;
                                break;
                            case '5000+':
                                cumplePrecio = precio > 5000;
                                break;
                        }
                    }

                    if (cumpleBusqueda && cumpleTipo && cumpleFecha && cumplePrecio) {
                        fila.style.display = '';
                        contador++;
                    } else {
                        fila.style.display = 'none';
                    }
                } catch (error) {
                    console.error('Error al procesar fila:', error);
                }
            });

            // Actualizar el contador de resultados
            contadorElement.textContent = contador;
        } catch (error) {
            console.error('Error en aplicarFiltrosEnTiempoReal:', error);
        }
    }

    // Inicializar event listeners cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Filtros ahora se realizan en el backend mediante submit del formulario.
// Código JS de filtrado en tiempo real deshabilitado.

// Limpiar filtros: redirige al mismo endpoint sin parámetros
const btnLimpiar = document.getElementById('btnLimpiarFiltros');
if (btnLimpiar) {
    btnLimpiar.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = window.location.pathname;
    });
}

    });

    // Función para limpiar filtros
    function limpiarFiltros() {
        document.getElementById('searchText').value = '';
        document.getElementById('tipoViaje').value = '';
        document.getElementById('fechaInicio').value = '';
        document.getElementById('fechaFin').value = '';
        document.getElementById('filtroPrecio').value = '';
        aplicarFiltrosEnTiempoReal();
    }

    function verDetalles(id) {
        fetch(`/administracion/viajes/${id}`)
            .then(response => response.json())
            .then(viaje => {
                document.getElementById('detalleTipo').textContent = `Viaje ${viaje.tipo.charAt(0).toUpperCase() + viaje.tipo.slice(1)}`;
                document.getElementById('detalleOrigen').textContent = viaje.origen;
                document.getElementById('detalleDestino').textContent = viaje.destino;
                document.getElementById('detalleFechaSalida').textContent = new Date(viaje.fecha_salida).toLocaleString();
                document.getElementById('detalleFechaLlegada').textContent = new Date(viaje.fecha_llegada).toLocaleString();
                document.getElementById('detallePrecio').textContent = `$${parseFloat(viaje.precio).toLocaleString('es-ES', {minimumFractionDigits: 2})}`;
                document.getElementById('detalleDescripcion').textContent = viaje.descripcion || 'Sin descripción';
                
                const imgDetalle = document.querySelector('#imagenDetalle img');
                if (viaje.imagen) {
                    imgDetalle.src = `data:image/jpeg;base64,${viaje.imagen}`;
                } else {
                    imgDetalle.src = "{{ asset('img/no-image.png') }}";
                }
                
                detallesModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar los detalles del viaje');
            });
    }

    function resetForm() {
        document.getElementById('viajeForm').reset();
        document.getElementById('viaje_id').value = '';
        document.getElementById('imagenPreview').innerHTML = '';
        document.getElementById('viajeModalLabel').textContent = 'Nuevo Viaje';
    }
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleSidebar');

        if (toggleBtn && sidebar && mainContent) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                mainContent.classList.toggle('expanded');
            });

            // Cerrar el menú al hacer clic fuera de él
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = toggleBtn.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    mainContent.classList.remove('expanded');
                }
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleSidebar');

        if (toggleBtn && sidebar && mainContent) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                mainContent.classList.toggle('expanded');
            });

            // Cerrar el menú al hacer clic fuera de él
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = toggleBtn.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    mainContent.classList.remove('expanded');
                }
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('toggleSidebar');

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('expanded');
        });

        // Cerrar el menú al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = toggleBtn.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                mainContent.classList.remove('expanded');
            }
        });
    });
</script>
</body>
</html>
