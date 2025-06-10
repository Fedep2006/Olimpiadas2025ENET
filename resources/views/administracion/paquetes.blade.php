<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Promociones - Frategar Admin</title>
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

        .status-expired {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-scheduled {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-paused {
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

        .action-btn.pause {
            background-color: #6c757d;
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

        .promo-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .promo-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--despegar-orange), #ff8533);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .promo-details h6 {
            margin: 0;
            font-weight: bold;
        }

        .promo-details small {
            color: #6c757d;
        }

        .discount-badge {
            background: linear-gradient(135deg, var(--despegar-orange), #ff8533);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1rem;
        }

        .usage-stats {
            text-align: center;
        }

        .usage-number {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--despegar-blue);
        }

        .usage-bar {
            width: 100px;
            height: 6px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
            margin: 5px auto;
        }

        .usage-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--despegar-blue), var(--despegar-orange));
            border-radius: 3px;
        }

        .type-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .type-percentage {
            background-color: #e7f3ff;
            color: #0066cc;
        }

        .type-fixed {
            background-color: #fff3e0;
            color: #ff6600;
        }

        .type-bogo {
            background-color: #f3e5f5;
            color: #9c27b0;
        }

        .type-free {
            background-color: #e8f5e8;
            color: #2e7d32;
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
            <a href="/administracion/hoteles" class="menu-item">
                <i class="fas fa-bed"></i>
                <span class="menu-text">Hoteles</span>
            </a>
            <a href="/administracion/vehiculos" class="menu-item">
                <i class="fas fa-car"></i>
                <span class="menu-text">Vehiculos</span>
            </a>
            <a href="/administracion/paquetes" class="menu-item active">
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
                <h4>Gestión de Promociones</h4>
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
                        <h1 class="page-title">Gestión de Paquetes</h1>
                        <p class="page-subtitle">Crea y administra ofertas especiales y descuentos</p>
                    </div>
                    <a href="#" class="btn-admin orange">
                        <i class="fas fa-plus"></i>
                        Nueva Promoción
                    </a>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-number">47</div>
                    <div class="stat-label">Total Paquetes</div>
                </div>
                <div class="stat-card" style="border-left-color: #28a745;">
                    <div class="stat-number">32</div>
                    <div class="stat-label">Paquetes Activas</div>
                </div>
                <div class="stat-card" style="border-left-color: #ffc107;">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Programadas</div>
                </div>
                <div class="stat-card" style="border-left-color: #dc3545;">
                    <div class="stat-number">7</div>
                    <div class="stat-label">Expiradas</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="content-card">
                <div class="search-filters">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label class="form-label">Nombre de la PAquete</label>
                            <input type="text" class="form-control" placeholder="Buscar por nombre o código">
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Tipo</label>
                            <select class="form-select">
                                <option value="">Todos los tipos</option>
                                <option value="percentage">Descuento %</option>
                                <option value="fixed">Descuento fijo</option>
                                <option value="bogo">2x1</option>
                                <option value="free">Gratis</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Categoría</label>
                            <select class="form-select">
                                <option value="">Todas las categorías</option>
                                <option value="flights">Vuelos</option>
                                <option value="hotels">Hoteles</option>
                                <option value="cars">Autos</option>
                                <option value="packages">Paquetes</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Estado</label>
                            <select class="form-select">
                                <option value="">Todos los estados</option>
                                <option value="active">Activa</option>
                                <option value="scheduled">Programada</option>
                                <option value="paused">Pausada</option>
                                <option value="expired">Expirada</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Fecha de Vencimiento</label>
                            <input type="date" class="form-control">
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

            <!-- Promotions Table -->
            <div class="content-card">
                <div class="card-header">
                    <h5 class="card-title">Lista de Paquetes</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn-admin">
                            <i class="fas fa-download"></i>
                            Exportar
                        </a>
                        <a href="#" class="btn-admin success">
                            <i class="fas fa-chart-line"></i>
                            Estadísticas
                        </a>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Promoción</th>
                                <th>Tipo</th>
                                <th>Descuento</th>
                                <th>Categoría</th>
                                <th>Vigencia</th>
                                <th>Uso</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="promo-info">
                                        <div class="promo-icon">
                                            <i class="fas fa-percentage"></i>
                                        </div>
                                        <div class="promo-details">
                                            <h6>Descuento Verano 2024</h6>
                                            <small>Código: VERANO24</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge type-percentage">Descuento %</span>
                                </td>
                                <td>
                                    <div class="discount-badge">25% OFF</div>
                                </td>
                                <td>
                                    <div><strong>Vuelos</strong></div>
                                    <small class="text-muted">Destinos internacionales</small>
                                </td>
                                <td>
                                    <div><strong>01/03 - 31/03</strong></div>
                                    <small class="text-muted">30 días restantes</small>
                                </td>
                                <td>
                                    <div class="usage-stats">
                                        <div class="usage-number">847/1000</div>
                                        <div class="usage-bar">
                                            <div class="usage-fill" style="width: 84.7%;"></div>
                                        </div>
                                        <small class="text-muted">84.7% usado</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-active">Activa</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn pause" title="Pausar">
                                            <i class="fas fa-pause"></i>
                                        </button>
                                        <button class="action-btn delete" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="promo-info">
                                        <div class="promo-icon">
                                            <i class="fas fa-dollar-sign"></i>
                                        </div>
                                        <div class="promo-details">
                                            <h6>Descuento Fijo Hoteles</h6>
                                            <small>Código: HOTEL100</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge type-fixed">Descuento Fijo</span>
                                </td>
                                <td>
                                    <div class="discount-badge">$100 OFF</div>
                                </td>
                                <td>
                                    <div><strong>Hoteles</strong></div>
                                    <small class="text-muted">Reservas +$500</small>
                                </td>
                                <td>
                                    <div><strong>15/03 - 15/04</strong></div>
                                    <small class="text-muted">15 días restantes</small>
                                </td>
                                <td>
                                    <div class="usage-stats">
                                        <div class="usage-number">234/500</div>
                                        <div class="usage-bar">
                                            <div class="usage-fill" style="width: 46.8%;"></div>
                                        </div>
                                        <small class="text-muted">46.8% usado</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-active">Activa</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn pause" title="Pausar">
                                            <i class="fas fa-pause"></i>
                                        </button>
                                        <button class="action-btn delete" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="promo-info">
                                        <div class="promo-icon">
                                            <i class="fas fa-gift"></i>
                                        </div>
                                        <div class="promo-details">
                                            <h6>2x1 en Autos</h6>
                                            <small>Código: AUTO2X1</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge type-bogo">2x1</span>
                                </td>
                                <td>
                                    <div class="discount-badge">2x1</div>
                                </td>
                                <td>
                                    <div><strong>Autos</strong></div>
                                    <small class="text-muted">Fines de semana</small>
                                </td>
                                <td>
                                    <div><strong>01/04 - 30/04</strong></div>
                                    <small class="text-success">Programada</small>
                                </td>
                                <td>
                                    <div class="usage-stats">
                                        <div class="usage-number">0/200</div>
                                        <div class="usage-bar">
                                            <div class="usage-fill" style="width: 0%;"></div>
                                        </div>
                                        <small class="text-muted">0% usado</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-scheduled">Programada</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn pause" title="Pausar">
                                            <i class="fas fa-pause"></i>
                                        </button>
                                        <button class="action-btn delete" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="promo-info">
                                        <div class="promo-icon">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="promo-details">
                                            <h6>Envío Gratis Paquetes</h6>
                                            <small>Código: FREEPACK</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge type-free">Gratis</span>
                                </td>
                                <td>
                                    <div class="discount-badge">Envío Gratis</div>
                                </td>
                                <td>
                                    <div><strong>Paquetes</strong></div>
                                    <small class="text-muted">Todos los destinos</small>
                                </td>
                                <td>
                                    <div><strong>10/02 - 10/03</strong></div>
                                    <small class="text-warning">Pausada</small>
                                </td>
                                <td>
                                    <div class="usage-stats">
                                        <div class="usage-number">156/300</div>
                                        <div class="usage-bar">
                                            <div class="usage-fill" style="width: 52%;"></div>
                                        </div>
                                        <small class="text-muted">52% usado</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-paused">Pausada</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn pause" title="Reanudar"
                                            style="background-color: #28a745;">
                                            <i class="fas fa-play"></i>
                                        </button>
                                        <button class="action-btn delete" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="promo-info">
                                        <div class="promo-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="promo-details">
                                            <h6>Early Bird 2024</h6>
                                            <small>Código: EARLY2024</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="type-badge type-percentage">Descuento %</span>
                                </td>
                                <td>
                                    <div class="discount-badge">15% OFF</div>
                                </td>
                                <td>
                                    <div><strong>Vuelos</strong></div>
                                    <small class="text-muted">Reservas anticipadas</small>
                                </td>
                                <td>
                                    <div><strong>01/01 - 28/02</strong></div>
                                    <small class="text-danger">Expirada</small>
                                </td>
                                <td>
                                    <div class="usage-stats">
                                        <div class="usage-number">1000/1000</div>
                                        <div class="usage-bar">
                                            <div class="usage-fill" style="width: 100%;"></div>
                                        </div>
                                        <small class="text-muted">100% usado</small>
                                    </div>
                                </td>
                                <td><span class="status-badge status-expired">Expirada</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Duplicar"
                                            style="background-color: #17a2b8;">
                                            <i class="fas fa-copy"></i>
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
