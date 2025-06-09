<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración del Sistema - Frategar Admin</title>
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
            border-bottom: 1px solid rgba(255,255,255,0.1);
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
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255,255,255,0.1);
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
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
        
        .btn-admin.danger {
            background-color: #dc3545;
        }
        
        .config-tabs {
            display: flex;
            gap: 5px;
            margin-bottom: 25px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .config-tab {
            padding: 12px 20px;
            background: none;
            border: none;
            color: #6c757d;
            font-weight: 500;
            border-radius: 8px 8px 0 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .config-tab.active {
            background: white;
            color: var(--despegar-blue);
            border-bottom: 2px solid var(--despegar-blue);
        }
        
        .config-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            color: var(--despegar-blue);
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            background: var(--despegar-light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--despegar-blue);
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }
        
        .form-text {
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: var(--despegar-blue);
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }
        
        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .setting-item:last-child {
            border-bottom: none;
        }
        
        .setting-info {
            flex: 1;
        }
        
        .setting-title {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 3px;
        }
        
        .setting-description {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .api-key-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid var(--despegar-blue);
        }
        
        .api-key-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .api-key-name {
            font-weight: bold;
            color: var(--despegar-blue);
        }
        
        .api-key-status {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
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
        
        .api-key-value {
            font-family: 'Courier New', monospace;
            background: white;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 0.85rem;
            color: #495057;
            margin-bottom: 10px;
        }
        
        .backup-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .backup-info {
            flex: 1;
        }
        
        .backup-name {
            font-weight: 500;
            color: #2c3e50;
        }
        
        .backup-details {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .backup-size {
            color: var(--despegar-blue);
            font-weight: 500;
            margin-right: 15px;
        }
        
        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
        }
        
        .alert-info {
            background-color: #e7f3ff;
            color: #0066cc;
            border-left: 4px solid var(--despegar-blue);
        }
        
        .alert-warning {
            background-color: #fff8e1;
            color: #ff6600;
            border-left: 4px solid var(--despegar-orange);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
      <!-- Sidebar -->
    <div class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                <i class="fas fa-plane me-2"></i>
                <span class="brand-text">Frategar Admin</span>
            </a>
        </div>
        
        <nav class="sidebar-menu">
            <a href="/dashboard" class="menu-item ">
                <i class="fas fa-tachometer-alt"></i>
                <span class="menu-text">Dashboard</span>
            </a>
            <a href="/dashboard/reservas" class="menu-item">
                <i class="fas fa-calendar-check"></i>
                <span class="menu-text">Reservas</span>
            </a>
            <a href="/dashboard/usuarios" class="menu-item">
                <i class="fas fa-users"></i>
                <span class="menu-text">Usuarios</span>
            </a>
            <a href="/dashboard/vuelos" class="menu-item">
                <i class="fas fa-plane"></i>
                <span class="menu-text">Vuelos</span>
            </a>
            <a href="/dashboard/hoteles" class="menu-item">
                <i class="fas fa-bed"></i>
                <span class="menu-text">Hoteles</span>
            </a>
            <a href="/dashboard/autos" class="menu-item">
                <i class="fas fa-car"></i>
                <span class="menu-text">Autos</span>
            </a>
            <a href="/dashboard/promociones" class="menu-item">
                <i class="fas fa-tags"></i>
                <span class="menu-text">Promociones</span>
            </a>
            <a href="/dashboard/reportes" class="menu-item">
                <i class="fas fa-chart-bar"></i>
                <span class="menu-text">Reportes</span>
            </a>
            <a href="/dashboard/configuracion" class="menu-item  active">
                <i class="fas fa-cog"></i>
                <span class="menu-text">Configuración</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span class="menu-text">Cerrar Sesión</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="admin-header">
                <h4>Configuración del Sistema</h4>
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
                        <h1 class="page-title">Configuración del Sistema</h1>
                        <p class="page-subtitle">Administra las configuraciones generales de la plataforma</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn-admin success">
                            <i class="fas fa-save"></i>
                            Guardar Cambios
                        </a>
                        <a href="#" class="btn-admin danger">
                            <i class="fas fa-undo"></i>
                            Restaurar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Configuration Tabs -->
            <div class="content-card">
                <div class="config-tabs">
                    <button class="config-tab active">
                        <i class="fas fa-cog me-2"></i>
                        General
                    </button>
                    <button class="config-tab">
                        <i class="fas fa-envelope me-2"></i>
                        Notificaciones
                    </button>
                    <button class="config-tab">
                        <i class="fas fa-key me-2"></i>
                        API & Integraciones
                    </button>
                    <button class="config-tab">
                        <i class="fas fa-shield-alt me-2"></i>
                        Seguridad
                    </button>
                    <button class="config-tab">
                        <i class="fas fa-database me-2"></i>
                        Respaldos
                    </button>
                </div>

                <!-- General Settings -->
                <div class="config-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        Información de la Empresa
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nombre de la Empresa</label>
                                <input type="text" class="form-control" value="Frategar Travel">
                                <div class="form-text">Nombre que aparecerá en toda la plataforma</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Sitio Web</label>
                                <input type="url" class="form-control" value="https://frategar.com">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email de Contacto</label>
                                <input type="email" class="form-control" value="contacto@frategar.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Teléfono de Soporte</label>
                                <input type="tel" class="form-control" value="+1 (555) 123-4567">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <textarea class="form-control" rows="3">123 Travel Street, Suite 456
Miami, FL 33101
Estados Unidos</textarea>
                    </div>
                </div>

                <!-- Platform Settings -->
                <div class="config-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        Configuración de Plataforma
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Zona Horaria</label>
                                <select class="form-select">
                                    <option value="UTC-5">UTC-5 (Eastern Time)</option>
                                    <option value="UTC-6">UTC-6 (Central Time)</option>
                                    <option value="UTC-7">UTC-7 (Mountain Time)</option>
                                    <option value="UTC-8">UTC-8 (Pacific Time)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Moneda Principal</label>
                                <select class="form-select">
                                    <option value="USD">USD - Dólar Estadounidense</option>
                                    <option value="EUR">EUR - Euro</option>
                                    <option value="ARS">ARS - Peso Argentino</option>
                                    <option value="MXN">MXN - Peso Mexicano</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Idioma por Defecto</label>
                                <select class="form-select">
                                    <option value="es">Español</option>
                                    <option value="en">English</option>
                                    <option value="pt">Português</option>
                                    <option value="fr">Français</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Formato de Fecha</label>
                                <select class="form-select">
                                    <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                    <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                                    <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature Toggles -->
                <div class="config-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-toggle-on"></i>
                        </div>
                        Características del Sistema
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-title">Registro de Nuevos Usuarios</div>
                            <div class="setting-description">Permitir que nuevos usuarios se registren en la plataforma</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-title">Modo de Mantenimiento</div>
                            <div class="setting-description">Activar página de mantenimiento para usuarios</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-title">Verificación de Email</div>
                            <div class="setting-description">Requerir verificación de email para nuevos usuarios</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-title">Autenticación de Dos Factores</div>
                            <div class="setting-description">Habilitar 2FA para administradores</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-title">Análisis y Cookies</div>
                            <div class="setting-description">Permitir cookies de análisis y seguimiento</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Payment Settings -->
                <div class="config-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        Configuración de Pagos
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Comisión por Transacción (%)</label>
                                <input type="number" class="form-control" value="2.5" step="0.1" min="0" max="10">
                                <div class="form-text">Porcentaje de comisión aplicado a cada reserva</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tiempo de Expiración de Reserva (minutos)</label>
                                <input type="number" class="form-control" value="15" min="5" max="60">
                                <div class="form-text">Tiempo antes de que expire una reserva sin pagar</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-title">Pagos con Tarjeta de Crédito</div>
                            <div class="setting-description">Aceptar pagos con tarjetas Visa, MasterCard, American Express</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-title">PayPal</div>
                            <div class="setting-description">Permitir pagos a través de PayPal</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-info">
                            <div class="setting-title">Transferencias Bancarias</div>
                            <div class="setting-description">Aceptar pagos por transferencia bancaria</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>

                <!-- API Keys Section -->
                <div class="config-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-key"></i>
                        </div>
                        Claves API e Integraciones
                    </div>
                    
                    <div class="api-key-item">
                        <div class="api-key-header">
                            <span class="api-key-name">Google Maps API</span>
                            <span class="api-key-status status-active">Activa</span>
                        </div>
                        <div class="api-key-value">AIzaSyB***************************XYZ</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-sync"></i> Regenerar
                            </button>
                        </div>
                    </div>
                    
                    <div class="api-key-item">
                        <div class="api-key-header">
                            <span class="api-key-name">Stripe Payment Gateway</span>
                            <span class="api-key-status status-active">Activa</span>
                        </div>
                        <div class="api-key-value">sk_live_***************************ABC</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-sync"></i> Regenerar
                            </button>
                        </div>
                    </div>
                    
                    <div class="api-key-item">
                        <div class="api-key-header">
                            <span class="api-key-name">SendGrid Email Service</span>
                            <span class="api-key-status status-inactive">Inactiva</span>
                        </div>
                        <div class="api-key-value">SG.***************************DEF</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="fas fa-play"></i> Activar
                            </button>
                        </div>
                    </div>
                    
                    <button class="btn-admin orange">
                        <i class="fas fa-plus"></i>
                        Agregar Nueva API
                    </button>
                </div>

                <!-- Backup Settings -->
                <div class="config-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        Respaldos del Sistema
                    </div>
                    
                    <div class="alert alert-custom alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Los respaldos automáticos se ejecutan diariamente a las 2:00 AM UTC
                    </div>
                    
                    <div class="backup-item">
                        <div class="backup-info">
                            <div class="backup-name">Respaldo Completo - 25 Mar 2024</div>
                            <div class="backup-details">Base de datos, archivos y configuraciones</div>
                        </div>
                        <div class="backup-size">2.4 GB</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download"></i> Descargar
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="fas fa-undo"></i> Restaurar
                            </button>
                        </div>
                    </div>
                    
                    <div class="backup-item">
                        <div class="backup-info">
                            <div class="backup-name">Respaldo Incremental - 24 Mar 2024</div>
                            <div class="backup-details">Solo cambios desde el último respaldo</div>
                        </div>
                        <div class="backup-size">156 MB</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download"></i> Descargar
                            </button>
                            <button class="btn btn-sm btn-outline-success">
                                <i class="fas fa-undo"></i> Restaurar
                            </button>
                        </div>
                    </div>
                    
                    <div class="backup-item">
                        <div class="backup-info">
                            <div class="backup-name">Respaldo Completo - 23 Mar 2024</div>
                            <div class="backup-details">Base de datos, archivos y configuraciones</div>
                        </div>
                        <div class="backup-size">2.3 GB</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-download"></i> Descargar
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 mt-3">
                        <button class="btn-admin success">
                            <i class="fas fa-play"></i>
                            Crear Respaldo Ahora
                        </button>
                        <button class="btn-admin">
                            <i class="fas fa-cog"></i>
                            Configurar Programación
                        </button>
                    </div>
                    
                    <div class="setting-item mt-3">
                        <div class="setting-info">
                            <div class="setting-title">Respaldos Automáticos</div>
                            <div class="setting-description">Ejecutar respaldos automáticos diariamente</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>

                <!-- System Information -->
                <div class="config-section">
                    <div class="section-title">
                        <div class="section-icon">
                            <i class="fas fa-server"></i>
                        </div>
                        Información del Sistema
                    </div>
                    
                    <div class="alert alert-custom alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Última actualización del sistema: 15 de Marzo, 2024 - Versión 2.4.1
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="metric-item">
                                <span class="metric-label">Versión del Sistema</span>
                                <span class="metric-value">2.4.1</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Base de Datos</span>
                                <span class="metric-value">MySQL 8.0.32</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Servidor Web</span>
                                <span class="metric-value">Apache 2.4.54</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">PHP</span>
                                <span class="metric-value">8.2.0</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="metric-item">
                                <span class="metric-label">Tiempo de Actividad</span>
                                <span class="metric-value">45 días, 12 horas</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Uso de CPU</span>
                                <span class="metric-value">23%</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Uso de Memoria</span>
                                <span class="metric-value">67%</span>
                            </div>
                            <div class="metric-item">
                                <span class="metric-label">Espacio en Disco</span>
                                <span class="metric-value">156 GB / 500 GB</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 mt-3">
                        <button class="btn-admin">
                            <i class="fas fa-sync"></i>
                            Verificar Actualizaciones
                        </button>
                        <button class="btn-admin warning">
                            <i class="fas fa-tools"></i>
                            Herramientas de Sistema
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple tab functionality
        document.querySelectorAll('.config-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.config-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>