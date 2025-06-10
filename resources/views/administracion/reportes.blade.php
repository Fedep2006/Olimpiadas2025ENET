<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes y Análisis - Frategar Admin</title>
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--despegar-blue), var(--despegar-orange));
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.revenue {
            background: linear-gradient(135deg, #28a745, #20c997);
        }

        .stat-icon.bookings {
            background: linear-gradient(135deg, var(--despegar-blue), #0052a3);
        }

        .stat-icon.users {
            background: linear-gradient(135deg, var(--despegar-orange), #ff8533);
        }

        .stat-icon.growth {
            background: linear-gradient(135deg, #6f42c1, #8b5cf6);
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stat-change.positive {
            color: #28a745;
        }

        .stat-change.negative {
            color: #dc3545;
        }

        .chart-container {
            height: 300px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-style: italic;
            position: relative;
            overflow: hidden;
        }

        .chart-placeholder {
            text-align: center;
        }

        .chart-bars {
            display: flex;
            align-items: end;
            justify-content: space-around;
            height: 200px;
            padding: 20px;
            gap: 10px;
        }

        .chart-bar {
            background: linear-gradient(180deg, var(--despegar-blue), var(--despegar-orange));
            border-radius: 4px 4px 0 0;
            min-width: 30px;
            position: relative;
            transition: all 0.3s ease;
        }

        .chart-bar:hover {
            opacity: 0.8;
            transform: translateY(-5px);
        }

        .chart-bar::after {
            content: attr(data-value);
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.8rem;
            font-weight: bold;
            color: var(--despegar-blue);
        }

        .chart-labels {
            display: flex;
            justify-content: space-around;
            padding: 10px 20px;
            font-size: 0.8rem;
            color: #6c757d;
        }

        .report-filters {
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

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .metric-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .metric-item:last-child {
            border-bottom: none;
        }

        .metric-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .metric-value {
            font-weight: bold;
            color: var(--despegar-blue);
        }

        .top-items {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .top-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .top-item:last-child {
            border-bottom: none;
        }

        .item-rank {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--despegar-light-blue);
            color: var(--despegar-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .item-info {
            flex: 1;
            margin-left: 15px;
        }

        .item-name {
            font-weight: 500;
            margin-bottom: 2px;
        }

        .item-details {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .item-value {
            font-weight: bold;
            color: var(--despegar-orange);
        }

        .progress-item {
            margin-bottom: 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .progress-label {
            font-weight: 500;
            color: #2c3e50;
        }

        .progress-value {
            font-weight: bold;
            color: var(--despegar-blue);
        }

        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: #e9ecef;
        }

        .progress-bar {
            border-radius: 4px;
            background: linear-gradient(90deg, var(--despegar-blue), var(--despegar-orange));
        }
    </style>
</head>

<body>
    <!-- Sidebar -->

    <div class="admin-sidebar">
        <div class="sidebar-header">
            <a href="/administracion" class="sidebar-brand">Frategar Admin</a>
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
            <a href="/administracion/paquetes" class="menu-item">
                <i class="fas fa-tags"></i>
                <span class="menu-text">Paquetes</span>
            </a>
            <a href="/administracion/reportes" class="menu-item active">
                <i class="fas fa-chart-bar"></i>
                <span class="menu-text">Reportes</span>
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
                <h4>Reportes y Análisis</h4>
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
                        <h1 class="page-title">Reportes y Análisis</h1>
                        <p class="page-subtitle">Métricas de rendimiento y análisis de datos</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn-admin">
                            <i class="fas fa-download"></i>
                            Exportar Reporte
                        </a>
                        <a href="#" class="btn-admin orange">
                            <i class="fas fa-calendar"></i>
                            Programar Reporte
                        </a>
                    </div>
                </div>
            </div>

            <!-- Report Filters -->
            <div class="content-card">
                <div class="report-filters">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label class="form-label">Período</label>
                            <select class="form-select">
                                <option value="today">Hoy</option>
                                <option value="week">Esta semana</option>
                                <option value="month" selected>Este mes</option>
                                <option value="quarter">Este trimestre</option>
                                <option value="year">Este año</option>
                                <option value="custom">Personalizado</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" value="2024-03-01">
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" value="2024-03-31">
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Categoría</label>
                            <select class="form-select">
                                <option value="all">Todas las categorías</option>
                                <option value="flights">Vuelos</option>
                                <option value="hotels">Hoteles</option>
                                <option value="cars">Autos</option>
                                <option value="packages">Paquetes</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn-admin">
                                <i class="fas fa-sync"></i>
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Metrics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-number">$2.4M</div>
                            <div class="stat-label">Ingresos Totales</div>
                        </div>
                        <div class="stat-icon revenue">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +12.5% vs mes anterior
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-number">8,947</div>
                            <div class="stat-label">Reservas Totales</div>
                        </div>
                        <div class="stat-icon bookings">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +8.3% vs mes anterior
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-number">1,234</div>
                            <div class="stat-label">Nuevos Usuarios</div>
                        </div>
                        <div class="stat-icon users">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <div class="stat-change negative">
                        <i class="fas fa-arrow-down"></i>
                        -2.1% vs mes anterior
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-number">94.2%</div>
                            <div class="stat-label">Satisfacción Cliente</div>
                        </div>
                        <div class="stat-icon growth">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        +1.8% vs mes anterior
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="metrics-grid">
                <!-- Revenue Chart -->
                <div class="content-card">
                    <div class="card-header">
                        <h5 class="card-title">Ingresos por Día</h5>
                        <a href="#" class="btn-admin" style="padding: 5px 10px; font-size: 0.8rem;">
                            <i class="fas fa-expand"></i>
                        </a>
                    </div>
                    <div class="chart-container">
                        <div class="chart-bars">
                            <div class="chart-bar" style="height: 60%;" data-value="$85K"></div>
                            <div class="chart-bar" style="height: 80%;" data-value="$120K"></div>
                            <div class="chart-bar" style="height: 45%;" data-value="$67K"></div>
                            <div class="chart-bar" style="height: 90%;" data-value="$134K"></div>
                            <div class="chart-bar" style="height: 70%;" data-value="$98K"></div>
                            <div class="chart-bar" style="height: 85%;" data-value="$127K"></div>
                            <div class="chart-bar" style="height: 95%;" data-value="$142K"></div>
                        </div>
                        <div class="chart-labels">
                            <span>Lun</span>
                            <span>Mar</span>
                            <span>Mié</span>
                            <span>Jue</span>
                            <span>Vie</span>
                            <span>Sáb</span>
                            <span>Dom</span>
                        </div>
                    </div>
                </div>

                <!-- Bookings by Category -->
                <div class="content-card">
                    <div class="card-header">
                        <h5 class="card-title">Reservas por Categoría</h5>
                        <a href="#" class="btn-admin" style="padding: 5px 10px; font-size: 0.8rem;">
                            <i class="fas fa-expand"></i>
                        </a>
                    </div>
                    <div class="chart-container">
                        <div class="chart-bars">
                            <div class="chart-bar" style="height: 85%;" data-value="4,234"></div>
                            <div class="chart-bar" style="height: 65%;" data-value="2,891"></div>
                            <div class="chart-bar" style="height: 45%;" data-value="1,567"></div>
                            <div class="chart-bar" style="height: 25%;" data-value="892"></div>
                        </div>
                        <div class="chart-labels">
                            <span>Vuelos</span>
                            <span>Hoteles</span>
                            <span>Autos</span>
                            <span>Paquetes</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Metrics -->
            <div class="metrics-grid">
                <!-- Performance Metrics -->
                <div class="content-card">
                    <div class="card-header">
                        <h5 class="card-title">Métricas de Rendimiento</h5>
                    </div>
                    <div class="metric-item">
                        <span class="metric-label">Tasa de Conversión</span>
                        <span class="metric-value">3.2%</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-label">Valor Promedio de Reserva</span>
                        <span class="metric-value">$268</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-label">Tiempo Promedio en Sitio</span>
                        <span class="metric-value">4m 32s</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-label">Tasa de Rebote</span>
                        <span class="metric-value">42.1%</span>
                    </div>
                    <div class="metric-item">
                        <span class="metric-label">Usuarios Recurrentes</span>
                        <span class="metric-value">68.5%</span>
                    </div>
                </div>

                <!-- Top Destinations -->
                <div class="content-card">
                    <div class="card-header">
                        <h5 class="card-title">Destinos Más Populares</h5>
                    </div>
                    <ul class="top-items">
                        <li class="top-item">
                            <div class="item-rank">1</div>
                            <div class="item-info">
                                <div class="item-name">Miami, FL</div>
                                <div class="item-details">1,234 reservas</div>
                            </div>
                            <div class="item-value">$456K</div>
                        </li>
                        <li class="top-item">
                            <div class="item-rank">2</div>
                            <div class="item-info">
                                <div class="item-name">París, Francia</div>
                                <div class="item-details">987 reservas</div>
                            </div>
                            <div class="item-value">$389K</div>
                        </li>
                        <li class="top-item">
                            <div class="item-rank">3</div>
                            <div class="item-info">
                                <div class="item-name">Cancún, México</div>
                                <div class="item-details">856 reservas</div>
                            </div>
                            <div class="item-value">$298K</div>
                        </li>
                        <li class="top-item">
                            <div class="item-rank">4</div>
                            <div class="item-info">
                                <div class="item-name">Madrid, España</div>
                                <div class="item-details">743 reservas</div>
                            </div>
                            <div class="item-value">$267K</div>
                        </li>
                        <li class="top-item">
                            <div class="item-rank">5</div>
                            <div class="item-info">
                                <div class="item-name">Nueva York, NY</div>
                                <div class="item-details">692 reservas</div>
                            </div>
                            <div class="item-value">$234K</div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Progress Metrics -->
            <div class="content-card">
                <div class="card-header">
                    <h5 class="card-title">Objetivos del Mes</h5>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="progress-item">
                            <div class="progress-header">
                                <span class="progress-label">Ingresos Mensuales</span>
                                <span class="progress-value">$2.4M / $3M</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-header">
                                <span class="progress-label">Nuevos Usuarios</span>
                                <span class="progress-value">1,234 / 1,500</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 82%"></div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-header">
                                <span class="progress-label">Reservas Totales</span>
                                <span class="progress-value">8,947 / 10,000</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 89%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="progress-item">
                            <div class="progress-header">
                                <span class="progress-label">Satisfacción Cliente</span>
                                <span class="progress-value">94.2% / 95%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 99%"></div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-header">
                                <span class="progress-label">Tasa de Conversión</span>
                                <span class="progress-value">3.2% / 4%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-header">
                                <span class="progress-label">Retención de Usuarios</span>
                                <span class="progress-value">68.5% / 70%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 98%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
