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
            padding: 0;
            margin: 0;
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh !important;
            max-height: 100vh !important;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--despegar-blue) 0%, #004499 100%);
            color: white;
            z-index: 1000;
            overflow-y: hidden;
            transition: all 0.3s ease;
            box-sizing: border-box;
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
            padding: 1rem;
        }

        .admin-sidebar.collapsed .menu-item i {
            margin-right: 0;
            font-size: 1.2rem;
        }

        .admin-sidebar.show {
            left: 0;
        }

        .sidebar-header {
            padding: 1rem;
            height: 7.5vh;
            min-height: 60px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            box-sizing: border-box;
            justify-content: space-between;
            align-items: center;
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
            flex: 1;
        }

        .sidebar-brand i {
            flex-shrink: 0;
        }

        .sidebar-menu {
            display: flex;
            padding: 1rem 0 0 0;
            height: calc(92.5vh - 1rem);
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
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
            padding: 0.75rem 1.25rem;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            white-space: nowrap;
            box-sizing: border-box;
            min-height: 44px;
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
            flex-shrink: 0;
        }

        .menu-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .toggle-sidebar {
            display: flex;
            justify-content: center;
            align-items: center;
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
            flex-shrink: 0;
        }

        .toggle-sidebar:hover {
            color: var(--despegar-orange);
        }

        .main-content.collapsed {
            margin-left: 70px;
        }

        /* Media Queries para responsividad */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 280px;
            }

            .admin-sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-sidebar.collapsed {
                width: 60px;
                transform: translateX(-100%);
            }

            .admin-sidebar.collapsed.show {
                transform: translateX(0);
            }

            .sidebar-header {
                padding: 0.75rem;
                min-height: 50px;
            }

            .sidebar-brand {
                font-size: 1.25rem;
            }

            .menu-item {
                padding: 0.6rem 1rem;
                min-height: 40px;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.collapsed {
                margin-left: 0;
            }
        }

        @media (max-width: 480px) {
            :root {
                --sidebar-width: 250px;
            }

            .sidebar-header {
                padding: 0.5rem;
                min-height: 45px;
            }

            .sidebar-brand {
                font-size: 1rem;
                gap: 5px;
            }

            .menu-item {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
                min-height: 36px;
            }

            .menu-item i {
                width: 18px;
                margin-right: 10px;
                font-size: 0.9rem;
            }

            .admin-sidebar.collapsed {
                width: 50px;
            }

            .admin-sidebar.collapsed .menu-item {
                padding: 0.75rem;
            }

            .admin-sidebar.collapsed .menu-item i {
                font-size: 1rem;
            }
        }

        /* Overlay para móviles */
        @media (max-width: 768px) {
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .sidebar-overlay.show {
                opacity: 1;
                visibility: visible;
            }
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
                <a href="/administracion/empresas" class="menu-item {{ $empresas ?? '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="menu-text">Empresas</span>
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
                <a href="/administracion/paquetes/contenidos" class="menu-item {{ $paquetesContenidos ?? '' }}">
                    <i class="fas fa-tags"></i>
                    <span class="menu-text">Contenidos de Paquetes</span>
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
