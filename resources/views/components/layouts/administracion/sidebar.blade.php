<!DOCTYPE html>
<html lang="en">

<head>
    @include('administracion.partials.head')

    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
            --sidebar-width: 300px;
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
            transition: all 0.3s ease;
        }

        .admin-sidebar.collapsed {
            width: 70px;
        }

        .admin-sidebar.collapsed .menu-text {
            display: none;
        }

        .admin-sidebar.collapsed .sidebar-brand {
            display: none;
        }

        .admin-sidebar.collapsed .sidebar-header {
            justify-content: center;
        }

        .admin-sidebar.collapsed .toggle-sidebar {
            margin-right: 0;
        }

        .admin-sidebar.collapsed .menu-item {
            display: flex;
            width: 100%;
            justify-content: center;
            text-align: center;
            padding: 1vw 1vw;
        }

        .admin-sidebar.collapsed .menu-item i {
            margin-right: 0;
            font-size: 1.2rem;
        }

        .admin-sidebar.show {
            left: 0;
        }

        .sidebar-header {
            padding: 20px;
            height: 7.5vh;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 60px;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-right: 10px;
        }

        .sidebar-brand i {
            flex-shrink: 0;
        }

        .sidebar-menu {
            display: flex;
            padding: 20px 0 0 0;
            height: 92.5vh;
            flex-direction: column;
            justify-content: space-between;
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
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            white-space: nowrap;
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
            text-align: center;
        }

        .toggle-sidebar {
            display: flex;
            justify-content: center;
            align-items: center;
            background: none;
            margin-top: 1.6%;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0;
            transition: color 0.3s ease;
        }

        .toggle-sidebar:hover {
            color: var(--despegar-orange);
        }

        .main-content.collapsed {
            margin-left: 70px;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/administracion" class="sidebar-brand">
                <i class="fas fa-plane me-2"></i>
                Frategar Admin
            </a>
            <button class="toggle-sidebar" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->

        <nav class="sidebar-menu">
            <div>
                <a href="/administracion" class="menu-item {{ $inicio ?? '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Inicio</span>
                </a>
                <a href="/administracion/reservas" class="menu-item {{ $reservas ?? '' }}">
                    <i class="fas fa-calendar-check"></i>
                    <span class="menu-text">Reservas</span>
                </a>
                <a href="/administracion/usuarios" class="menu-item {{ $usuarios ?? '' }}">
                    <i class="fas fa-users"></i>
                    <span class="menu-text">Usuarios</span>
                </a>
                <a href="/administracion/viajes" class="menu-item {{ $viajes ?? '' }}">
                    <i class="fas fa-plane"></i>
                    <span class="menu-text">Viajes</span>
                </a>
                <a href="/administracion/hospedajes" class="menu-item {{ $hospedajes ?? '' }}">
                    <i class="fas fa-bed"></i>
                    <span class="menu-text">Hospedaje</span>
                </a>
                <a href="/administracion/vehiculos" class="menu-item {{ $vehiculos ?? '' }}">
                    <i class="fas fa-car"></i>
                    <span class="menu-text">Vehiculos</span>
                </a>
                <a href="/administracion/paquetes" class="menu-item {{ $paquetes ?? '' }}">
                    <i class="fas fa-tags"></i>
                    <span class="menu-text">Paquetes</span>
                </a>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item" style="height: 6vh;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="menu-text">Cerrar Sesión</span>
                </button>
            </form>
        </nav>
    </div>
</body>

</html>
