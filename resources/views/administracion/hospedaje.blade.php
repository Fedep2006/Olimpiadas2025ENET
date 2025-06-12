<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestión de Hoteles - Frategar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
            --sidebar-width: 280px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        .menu-item {
            display: block;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
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
            margin-right: 15px;
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
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h4 {
            color: var(--despegar-blue);
            margin: 0;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--despegar-light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
            font-weight: bold;
        }

        .dashboard-content {
            padding: 30px;
        }

        .page-header {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .page-title {
            color: var(--despegar-blue);
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }

        .page-subtitle {
            color: #6c757d;
            margin: 5px 0 0 0;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .card-title {
            color: var(--despegar-blue);
            font-weight: bold;
            margin: 0;
        }

        .btn-admin {
            background-color: var(--despegar-blue);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-admin:hover {
            background-color: #0052a3;
            color: white;
        }

        .btn-admin.orange {
            background-color: var(--despegar-orange);
        }

        .btn-admin.success {
            background-color: #28a745;
        }

        .btn-admin.warning {
            background-color: #ffc107;
            color: #212529;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-maintenance {
            background-color: #fff3cd;
            color: #856404;
        }

        .search-filters {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .filter-row {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .form-label {
            font-weight: 500;
            color: var(--despegar-blue);
            margin-bottom: 5px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 12px;
        }

        .table-container {
            overflow-x: auto;
        }

        .table th {
            background-color: var(--despegar-light-blue);
            color: var(--despegar-blue);
            font-weight: bold;
            border: none;
            padding: 15px 12px;
        }

        .table td {
            padding: 15px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .action-btn.view {
            background-color: #17a2b8;
            color: white;
        }

        .action-btn.edit {
            background-color: #ffc107;
            color: #212529;
        }

        .action-btn.delete {
            background-color: #dc3545;
            color: white;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--despegar-blue);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--despegar-blue);
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .hotel-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hotel-image {
            width: 60px;
            height: 45px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--despegar-light-blue), #cce7ff);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
            font-size: 1.2rem;
        }

        .hotel-details h6 {
            margin: 0;
            font-weight: bold;
        }

        .hotel-details small {
            color: #6c757d;
        }

        .rating-stars {
            color: #ffc107;
            margin-right: 5px;
        }

        .price-info {
            text-align: right;
        }

        .price-amount {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--despegar-orange);
        }

        .occupancy-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .occupancy-bar {
            width: 100px;
            height: 6px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .occupancy-fill {
            height: 100%;
            border-radius: 3px;
        }

        .occupancy-high {
            background-color: #dc3545;
        }

        .occupancy-medium {
            background-color: #ffc107;
        }

        .occupancy-low {
            background-color: #28a745;
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
            <a href="/administracion" class="menu-item ">
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
            <a href="/administracion/viajes" class="menu-item">
                <i class="fas fa-plane"></i>
                <span class="menu-text">Viajes</span>
            </a>
            <a href="/administracion/hospedajes" class="menu-item active">
                <i class="fas fa-bed"></i>
                <span class="menu-text">Hospedaje</span>
            </a>
            <a href="/administracion/vehiculos" class="menu-item">
                <i class="fas fa-car"></i>
                <span class="menu-text">Vehiculos</span>
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

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="admin-header">
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h4>Gestión de Hoteles</h4>
            </div>

            <div class="admin-user">
                <div class="user-avatar">{{ substr(Auth::user()->name, 0, 2) }}</div>
                <div>
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small class="text-muted">{{ Auth::user()->role }}</small>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none p-0 ms-2">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">Gestión de Hospedaje</h1>
                        <p class="page-subtitle">Administra el inventario de hoteles y habitaciones</p>
                    </div>
                    <a href="#" class="btn-admin orange" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-plus"></i>
                        Nuevo Hotel
                    </a>
                </div>
            </div>

            <!-- Hotels Table -->
            <div class="content-card">
                <div class="card-header">
                    <h5 class="card-title">Lista de Hospedajes</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('administracion.hospedaje') }}" class="btn-admin warning">
                            <i class="fas fa-sync"></i>
                            Sincronizar
                        </a>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hospedaje</th> <!-- Nombre del hospedaje -->
                                <th>Estrellas</th> <!-- Nombre del hospedaje -->
                                <th>Ubicación</th> <!-- Ubicación del hospedaje -->
                                <th>Categoría</th> <!-- Tipo del hospedaje -->
                                <th>Servicios</th>
                                <th>Politicas</th>
                                <th>Descripcion</th> <!-- Habitaciones del hospedaje -->
                                <th>Contacto</th> <!-- Habitaciones del hospedaje -->
                                <th>Precio Por Noche</th>
                                <th>Horario</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hospedajes as $hospedaje)
                            <tr>
                                <td>
                                    <div class="hotel-info">
                                        <div class="hotel-image">
                                            <img src="{{ $hospedaje->imagen }}" alt="Imagen del hospedaje">
                                        </div>
                                        <div class="hotel-details">
                                            <h6>{{ $hospedaje->nombre }}</h6>
                                            <small>ID:</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div><strong></strong></div>
                                    <small class="text-muted"></small>
                                </td>
                                <td>
                                    <div class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        @for($i = 0; $i < $hospedaje->estrellas; $i++)
                                        <i class="fas fa-star"></i>
                                        @endfor
                                        @for($i = $hospedaje->estrellas; $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                        @endfor
                                        <small class="text-muted">{{ $hospedaje->clasificacion }}</small>
                                    </div>
                                    <small class="text-muted"> Estrellas</small>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $hospedaje->ubicacion }}</small>
                                    <small class="text-muted">{{ $hospedaje->pais }}</small>
                                    <small class="text-muted">{{ $hospedaje->ciudad }}</small>
                                    <small class="text-muted">{{ $hospedaje->codigo_postal }}</small>
                                </td>
                                <td>
                                    <div><strong>{{ $hospedaje->tipo }}</strong></div>
                                </td>
                                <td>
                                    <small class="text-muted">Servicios: {{ $hospedaje->servicios }}</small>
                                    <small class="text-muted">Politicas: {{ $hospedaje->politicas }}</small>
                                </td>
                                <td>
                                    <div><strong>{{ $hospedaje->descripcion }}</strong></div>
                                </td>
                                <td>
                                    <div><strong>{{ $hospedaje->telefono }}</strong></div>
                                    <small class="text-muted">{{ $hospedaje->email }}</small>
                                    <small class="text-muted">{{ $hospedaje->sitio_web }}</small>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="price-amount">${{ $hospedaje->precio_por_noche }}</div>
                                        <small class="text-muted">por noche</small>
                                    </div>
                                </td>
                                <td>
                                    <div><strong>{{ $hospedaje->check_in_24h }}</strong></div>
                                    <small class="text-muted">{{ $hospedaje->check_in }}</small>
                                    <small class="text-muted">{{ $hospedaje->check_out }}</small>
                                </td>
                                <td>
                                    @if($hospedaje->disponibilidad == 1)
                                    <span class="status-badge status-active">Activo</span>
                                    @else
                                    <span class="status-badge status-inactive">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Desactivar">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Modal Crear -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Nuevo Hospedaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre de Hospedaje</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="255">
                                </div>
                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo</label>
                                    <select class="form-select" id="tipo" name="tipo" required>
                                        <option value="">Seleccione un tipo</option>
                                        <option value="hotel">Hotel</option>
                                        <option value="hostal">Hostal</option>
                                        <option value="apartamento">Apartamento</option>
                                        <option value="casa">Casa</option>
                                        <option value="cabaña">Cabaña</option>
                                        <option value="resort">Resort</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pais" class="form-label">País</label>
                                    <input type="text" class="form-control" id="pais" name="pais" required maxlength="100">
                                </div>
                                <div class="mb-3">
                                    <label for="ciudad" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" required maxlength="100">
                                </div>
                                <div class="mb-3">
                                    <label for="ubicacion" class="form-label">Ubicación</label>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required maxlength="255">
                                </div>
                                <div class="mb-3">
                                    <label for="codigo_postal" class="form-label">Código Postal</label>
                                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="estrellas" class="form-label">Estrellas</label>
                                    <select class="form-select" id="estrellas" name="estrellas">
                                        <option value="">Seleccione una cantidad de estrellas</option>
                                        <option value="1">1 Estrella</option>
                                        <option value="2">2 Estrellas</option>
                                        <option value="3">3 Estrellas</option>
                                        <option value="4">4 Estrellas</option>
                                        <option value="5">5 Estrellas</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="disponibilidad" class="form-label">Disponibilidad</label>
                                    <select class="form-select" id="disponibilidad" name="disponibilidad">
                                        <option value="1">Disponible</option>
                                        <option value="0">No Disponible</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="20">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" maxlength="100">
                                </div>
                                <div class="mb-3">
                                    <label for="sitio_web" class="form-label">Sitio Web</label>
                                    <input type="text" class="form-control" id="sitio_web" name="sitio_web" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="servicios" class="form-label">Servicios</label>
                                    <select class="form-select" id="servicios" name="servicios[]" multiple>
                                        <option value="wifi">WiFi</option>
                                        <option value="piscina">Piscina</option>
                                        <option value="restaurante">Restaurante</option>
                                        <option value="gimnasio">Gimnasio</option>
                                        <option value="spa">Spa</option>
                                        <option value="estacionamiento">Estacionamiento</option>
                                        <option value="aire_acondicionado">Aire Acondicionado</option>
                                        <option value="servicio_habitacion">Servicio a la Habitación</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="imagenes" class="form-label">URLs de Imágenes</label>
                                    <select class="form-select" id="imagenes" name="imagenes[]" multiple>
                                        <!-- Las URLs se pueden agregar dinámicamente -->
                                    </select>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" id="nueva_imagen" placeholder="Agregar URL de imagen" maxlength="255">
                                        <button type="button" class="btn btn-sm btn-primary mt-2" onclick="agregarImagen()">Agregar Imagen</button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="check_in" class="form-label">Horario de Check-in</label>
                                    <input type="time" class="form-control" id="check_in" name="check_in" required>
                                </div>
                                <div class="mb-3">
                                    <label for="check_out" class="form-label">Horario de Check-out</label>
                                    <input type="time" class="form-control" id="check_out" name="check_out" required>
                                </div>
                                <div class="mb-3">
                                    <label for="check_in_24h" class="form-label">Check-in 24 horas</label>
                                    <select class="form-select" id="check_in_24h" name="check_in_24h">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="calificacion" class="form-label">Calificación</label>
                                    <input type="number" class="form-control" id="calificacion" name="calificacion" min="0" max="5" step="0.01">
                                </div>
                                <div class="mb-3">
                                    <label for="politicas" class="form-label">Políticas</label>
                                    <select class="form-select" id="politicas" name="politicas[]" multiple>
                                        <option value="mascotas">Mascotas Permitidas</option>
                                        <option value="fumar">Fumar Permitido</option>
                                        <option value="ninos">Niños Bienvenidos</option>
                                        <option value="cancelacion">Política de Cancelación</option>
                                        <option value="pago">Política de Pago</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="observaciones" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Hospedaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_nombre" class="form-label">Nombre de Hospedaje</label>
                                    <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_tipo" class="form-label">Tipo</label>
                                    <select class="form-select" id="edit_tipo" name="tipo" required>
                                        <option value="">Seleccione un tipo</option>
                                        <option value="hotel">Hotel</option>
                                        <option value="hostal">Hostal</option>
                                        <option value="apartamento">Apartamento</option>
                                        <option value="casa">Casa</option>
                                        <option value="cabaña">Cabaña</option>
                                        <option value="resort">Resort</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_pais" class="form-label">País</label>
                                    <input type="text" class="form-control" id="edit_pais" name="pais" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_ciudad" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="edit_ciudad" name="ciudad" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_ubicacion" class="form-label">Ubicación</label>
                                    <input type="text" class="form-control" id="edit_ubicacion" name="ubicacion" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_codigo_postal" class="form-label">Código Postal</label>
                                    <input type="text" class="form-control" id="edit_codigo_postal" name="codigo_postal" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_estrellas" class="form-label">Estrellas</label>
                                    <select class="form-select" id="edit_estrellas" name="estrellas" required>
                                        <option value="">Seleccione una cantidad de estrellas</option>
                                        <option value="1">1 Estrella</option>
                                        <option value="2">2 Estrellas</option>
                                        <option value="3">3 Estrellas</option>
                                        <option value="4">4 Estrellas</option>
                                        <option value="5">5 Estrellas</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_disponibilidad" class="form-label">Disponibilidad</label>
                                    <select class="form-select" id="edit_disponibilidad" name="disponibilidad" required>
                                        <option value="1">Disponible</option>
                                        <option value="0">No Disponible</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="edit_telefono" name="telefono" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="edit_email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_sitio_web" class="form-label">Sitio Web</label>
                                    <input type="text" class="form-control" id="edit_sitio_web" name="sitio_web" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="edit_descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="edit_descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_servicios" class="form-label">Servicios</label>
                                    <select class="form-select" id="edit_servicios" name="servicios[]" multiple>
                                        <option value="wifi">WiFi</option>
                                        <option value="piscina">Piscina</option>
                                        <option value="restaurante">Restaurante</option>
                                        <option value="gimnasio">Gimnasio</option>
                                        <option value="spa">Spa</option>
                                        <option value="estacionamiento">Estacionamiento</option>
                                        <option value="aire_acondicionado">Aire Acondicionado</option>
                                        <option value="servicio_habitacion">Servicio a la Habitación</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_imagenes" class="form-label">URLs de Imágenes</label>
                                    <select class="form-select" id="edit_imagenes" name="imagenes[]" multiple>
                                        <!-- Las URLs se pueden agregar dinámicamente -->
                                    </select>
                                    <div class="mt-2">
                                        <input type="url" class="form-control" id="nueva_imagen_edit" placeholder="Agregar URL de imagen">
                                        <button type="button" class="btn btn-sm btn-primary mt-2" onclick="agregarImagenEdit()">Agregar Imagen</button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_check_in" class="form-label">Horario de Check-in</label>
                                    <input type="time" class="form-control" id="edit_check_in" name="check_in" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_check_out" class="form-label">Horario de Check-out</label>
                                    <input type="time" class="form-control" id="edit_check_out" name="check_out" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_check_in_24h" class="form-label">Check-in 24 horas</label>
                                    <select class="form-select" id="edit_check_in_24h" name="check_in_24h">
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_calificacion" class="form-label">Calificación</label>
                                    <input type="number" class="form-control" id="edit_calificacion" name="calificacion" min="0" max="5" step="0.01">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_politicas" class="form-label">Políticas</label>
                                    <select class="form-select" id="edit_politicas" name="politicas[]" multiple>
                                        <option value="mascotas">Mascotas Permitidas</option>
                                        <option value="fumar">Fumar Permitido</option>
                                        <option value="ninos">Niños Bienvenidos</option>
                                        <option value="cancelacion">Política de Cancelación</option>
                                        <option value="pago">Política de Pago</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_observaciones" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="edit_observaciones" name="observaciones" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    $(document).ready(function() {
        // Configurar CSRF token para todas las peticiones AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        // Inicializar select2 para campos múltiples
        $('#servicios, #politicas, #edit_servicios, #edit_politicas, #imagenes').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: 'Seleccione las opciones'
        });

        // Función para agregar imágenes
        window.agregarImagen = function() {
            let nuevaUrl = $('#nueva_imagen').val();
            if (nuevaUrl) {
                let option = new Option(nuevaUrl, nuevaUrl, true, true);
                $('#imagenes').append(option).trigger('change');
                $('#nueva_imagen').val('');
            }
        };

        // Función para agregar imágenes en el modal de edición
        window.agregarImagenEdit = function() {
            let nuevaUrl = $('#nueva_imagen_edit').val();
            if (nuevaUrl) {
                let option = new Option(nuevaUrl, nuevaUrl, true, true);
                $('#edit_imagenes').append(option).trigger('change');
                $('#nueva_imagen_edit').val('');
            }
        };

        // Crear hospedaje
        $('#createForm').on('submit', function(e) {
            e.preventDefault();
            
            let formData = $(this).serializeArray();
            
            $.ajax({
                url: '{{ route("administracion.hospedaje.Agregar") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if(response.success) {
                        $('#createModal').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for (let field in errors) {
                            errorMessage += errors[field].join('\n') + '\n';
                        }
                        alert(errorMessage);
                    } else {
                        alert('Error al crear el hospedaje');
                    }
                }
            });
        });

        // Editar hospedaje
        $('.edit-btn').click(function() {
            let id = $(this).data('id');
            let nombre = $(this).data('nombre');
            let tipo = $(this).data('tipo');
            let pais = $(this).data('pais');
            let ciudad = $(this).data('ciudad');
            let ubicacion = $(this).data('ubicacion');
            let codigo_postal = $(this).data('codigo_postal');
            let estrellas = $(this).data('estrellas');
            let disponibilidad = $(this).data('disponibilidad');
            let telefono = $(this).data('telefono');
            let email = $(this).data('email');
            let sitio_web = $(this).data('sitio_web');
            let descripcion = $(this).data('descripcion');
            let servicios = JSON.parse($(this).data('servicios') || '[]');
            let politicas = JSON.parse($(this).data('politicas') || '[]');
            let imagenes = JSON.parse($(this).data('imagenes') || '[]');
            let check_in = $(this).data('check_in');
            let check_out = $(this).data('check_out');
            let check_in_24h = $(this).data('check_in_24h');
            let calificacion = $(this).data('calificacion');

            $('#edit_id').val(id);
            $('#edit_nombre').val(nombre);
            $('#edit_tipo').val(tipo);
            $('#edit_pais').val(pais);
            $('#edit_ciudad').val(ciudad);
            $('#edit_ubicacion').val(ubicacion);
            $('#edit_codigo_postal').val(codigo_postal);
            $('#edit_estrellas').val(estrellas);
            $('#edit_disponibilidad').val(disponibilidad);
            $('#edit_telefono').val(telefono);
            $('#edit_email').val(email);
            $('#edit_sitio_web').val(sitio_web);
            $('#edit_descripcion').val(descripcion);
            $('#edit_servicios').val(servicios).trigger('change');
            $('#edit_politicas').val(politicas).trigger('change');
            $('#edit_imagenes').empty().append(imagenes.map(url => new Option(url, url, true, true)).join('')).trigger('change');
            $('#edit_check_in').val(check_in);
            $('#edit_check_out').val(check_out);
            $('#edit_check_in_24h').val(check_in_24h);
            $('#edit_calificacion').val(calificacion);
        });

        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            
            let formData = $(this).serializeArray();
            
            $.ajax({
                url: '{{ route("administracion.hospedaje.Editar") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if(response.success) {
                        $('#editModal').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        for (let field in errors) {
                            errorMessage += errors[field].join('\n') + '\n';
                        }
                        alert(errorMessage);
                    } else {
                        alert('Error al actualizar el hospedaje');
                    }
                }
            });
        });

        // Eliminar hospedaje
        $('.delete-btn').click(function() {
            if(confirm('¿Está seguro de eliminar este hospedaje?')) {
                let id = $(this).data('id');
                $.ajax({
                    url: '{{ url("administracion/hospedaje/eliminar") }}/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        if(response.success) {
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert('Error al eliminar el hospedaje');
                    }
                });
            }
        });

        // Manejar cambio en disponibilidad
        $('#disponibilidad, #edit_disponibilidad').change(function() {
            let horarioInputs = $('#check_in, #check_out');
            if ($(this).val() === '1') {
                horarioInputs.prop('disabled', true);
            } else {
                horarioInputs.prop('disabled', false);
            }
        });

        // Manejar cambio en check-in 24h
        $('#check_in_24h, #edit_check_in_24h').change(function() {
            let horarioInputs = $('#check_in, #check_out');
            if ($(this).val() === '1') {
                horarioInputs.prop('disabled', true);
            } else {
                horarioInputs.prop('disabled', false);
            }
        });
    });
    </script>
    @endpush
</body>

</html>
