<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vuelos - Frategar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--despegar-blue) 0%, #004499 100%);
            color: white;
            z-index: 1000;
            overflow-y: auto;
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
            margin-left: var(--sidebar-width);
            min-height: 100vh;
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

        .status-delayed {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
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

        .flight-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .airline-logo {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--despegar-light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
        }

        .flight-details h6 {
            margin: 0;
            font-weight: bold;
        }

        .flight-details small {
            color: #6c757d;
        }

        .route-info {
            font-weight: bold;
            color: var(--despegar-blue);
        }

        .price-info {
            text-align: right;
        }

        .price-amount {
            font-size: 1.2rem;
            font-weight: bold;
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
            <a href="/administracion/viajes" class="menu-item active">
                <i class="fas fa-plane"></i>
                <span class="menu-text">Viajes</span>
            </a>
            <a href="/administracion/hoteles" class="menu-item">
                <i class="fas fa-bed"></i>
                <span class="menu-text">Hoteles</span>
            </a>
            <a href="/administracion/vehiculos" class="menu-item">
                <i class="fas fa-car"></i>
                <span class="menu-text">Vehiculos</span>
            </a>
            <a href="/administracion/paquetes" class="menu-item">
                <i class="fas fa-tags"></i>
                <span class="menu-text">Paquetes</span>
            </a>
              <a href="/administracion/empleados" class="menu-item ">
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
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="admin-header">
                <h4>Gestión de Vuelos</h4>
            </div>

            <div class="admin-user">
                <div class="user-avatar">JP</div>
                <div>
                    <div class="fw-bold">Juan Pérez</div>
                    <small class="text-muted">Administrador</small>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">Gestión de Vuelos</h1>
                        <p class="page-subtitle">Administra el inventario de vuelos y horarios</p>
                    </div>
                    <a href="#" class="btn-admin orange">
                        <i class="fas fa-plus"></i>
                        Nuevo Vuelo
                    </a>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-number">1,847</div>
                    <div class="stat-label">Total Vuelos</div>
                </div>
                <div class="stat-card" style="border-left-color: #28a745;">
                    <div class="stat-number">1,654</div>
                    <div class="stat-label">Vuelos Activos</div>
                </div>
                <div class="stat-card" style="border-left-color: #ffc107;">
                    <div class="stat-number">123</div>
                    <div class="stat-label">Vuelos Retrasados</div>
                </div>
                <div class="stat-card" style="border-left-color: #dc3545;">
                    <div class="stat-number">70</div>
                    <div class="stat-label">Vuelos Cancelados</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="content-card">
                <div class="search-filters">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label class="form-label">Número de Vuelo</label>
                            <input type="text" class="form-control" placeholder="Ej: AA1205, LA533">
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Aerolínea</label>
                            <select class="form-select">
                                <option value="">Todas las aerolíneas</option>
                                <option value="american">American Airlines</option>
                                <option value="latam">LATAM</option>
                                <option value="aerolineas">Aerolíneas Argentinas</option>
                                <option value="united">United Airlines</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Origen</label>
                            <input type="text" class="form-control" placeholder="Ciudad o código aeropuerto">
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Destino</label>
                            <input type="text" class="form-control" placeholder="Ciudad o código aeropuerto">
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Estado</label>
                            <select class="form-select">
                                <option value="">Todos los estados</option>
                                <option value="active">Activo</option>
                                <option value="delayed">Retrasado</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button class="btn-admin">
                                    <i class="fas fa-search"></i>
                                    Buscar
                                </button>
                                <button class="btn-admin" style="background-color: #6c757d;">
                                    <i class="fas fa-times"></i>
                                    Limpiar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flights Table -->
            <div class="content-card">
                <div class="card-header">
                    <h5 class="card-title">Lista de Vuelos</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn-admin">
                            <i class="fas fa-download"></i>
                            Exportar
                        </a>
                        <a href="#" class="btn-admin warning">
                            <i class="fas fa-sync"></i>
                            Sincronizar
                        </a>
                        <a href="#" class="btn-admin success">
                            <i class="fas fa-upload"></i>
                            Importar
                        </a>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Vuelo</th>
                                <th>Ruta</th>
                                <th>Horarios</th>
                                <th>Aeronave</th>
                                <th>Capacidad</th>
                                <th>Precio Base</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flight-info">
                                        <div class="airline-logo">
                                            <i class="fas fa-plane"></i>
                                        </div>
                                        <div class="flight-details">
                                            <h6>AA 1205</h6>
                                            <small>American Airlines</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="route-info">EZE → MIA</div>
                                    <small class="text-muted">Buenos Aires - Miami</small>
                                </td>
                                <td>
                                    <div><strong>Salida:</strong> 08:30</div>
                                    <div><strong>Llegada:</strong> 14:15</div>
                                    <small class="text-muted">8h 45m</small>
                                </td>
                                <td>
                                    <div>Boeing 777-300ER</div>
                                    <small class="text-muted">Vuelo directo</small>
                                </td>
                                <td>
                                    <div><strong>368</strong> asientos</div>
                                    <small class="text-success">245 disponibles</small>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="price-amount">$899</div>
                                        <small class="text-muted">USD</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Cancelar">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flight-info">
                                        <div class="airline-logo">
                                            <i class="fas fa-plane"></i>
                                        </div>
                                        <div class="flight-details">
                                            <h6>LA 533</h6>
                                            <small>LATAM Airlines</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="route-info">EZE → MIA</div>
                                    <small class="text-muted">Buenos Aires - Miami</small>
                                </td>
                                <td>
                                    <div><strong>Salida:</strong> 14:20</div>
                                    <div><strong>Llegada:</strong> 20:35</div>
                                    <small class="text-muted">9h 15m</small>
                                </td>
                                <td>
                                    <div>Airbus A350-900</div>
                                    <small class="text-muted">Vuelo directo</small>
                                </td>
                                <td>
                                    <div><strong>325</strong> asientos</div>
                                    <small class="text-warning">89 disponibles</small>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="price-amount">$1,150</div>
                                        <small class="text-muted">USD</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-delayed">Retrasado</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Cancelar">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flight-info">
                                        <div class="airline-logo">
                                            <i class="fas fa-plane"></i>
                                        </div>
                                        <div class="flight-details">
                                            <h6>AR 1303</h6>
                                            <small>Aerolíneas Argentinas</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="route-info">EZE → MAD</div>
                                    <small class="text-muted">Buenos Aires - Madrid</small>
                                </td>
                                <td>
                                    <div><strong>Salida:</strong> 23:55</div>
                                    <div><strong>Llegada:</strong> 18:30+1</div>
                                    <small class="text-muted">12h 35m</small>
                                </td>
                                <td>
                                    <div>Airbus A330-200</div>
                                    <small class="text-muted">Vuelo directo</small>
                                </td>
                                <td>
                                    <div><strong>272</strong> asientos</div>
                                    <small class="text-danger">12 disponibles</small>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="price-amount">$1,450</div>
                                        <small class="text-muted">USD</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Cancelar">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flight-info">
                                        <div class="airline-logo">
                                            <i class="fas fa-plane"></i>
                                        </div>
                                        <div class="flight-details">
                                            <h6>UA 845</h6>
                                            <small>United Airlines</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="route-info">EZE → IAH → MIA</div>
                                    <small class="text-muted">Buenos Aires - Miami</small>
                                </td>
                                <td>
                                    <div><strong>Salida:</strong> 22:45</div>
                                    <div><strong>Llegada:</strong> 16:15+1</div>
                                    <small class="text-muted">12h 30m</small>
                                </td>
                                <td>
                                    <div>Boeing 787-9</div>
                                    <small class="text-muted">1 escala</small>
                                </td>
                                <td>
                                    <div><strong>296</strong> asientos</div>
                                    <small class="text-success">178 disponibles</small>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="price-amount">$1,299</div>
                                        <small class="text-muted">USD</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-cancelled">Cancelado</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
