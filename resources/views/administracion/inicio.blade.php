<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Panel Administrativo - Frategar</title>
    <style>
        /* Header */
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
        .btn-admin {
            background-color: var(--despegar-blue);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .btn-admin.orange {
            background-color: var(--despegar-orange);
        }
        .btn-admin.orange:hover {
            background-color: #e55a00;
        }

        /* Table */
        .data-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .table-header {
            background: var(--despegar-light-blue);
            padding: 20px 25px;
            border-bottom: 1px solid #dee2e6;
        }
        .table-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--despegar-blue);
            margin: 0;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        .table th {
            background-color: var(--despegar-light-blue);
            color: var(--despegar-blue);
            font-weight: bold;
            padding: 15px 12px;
            border: none;
            text-align: left;
        }
        .table td {
            padding: 15px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .status-confirmed {
            background-color: #d4edda;
            color: #155724;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-layouts.administracion.sidebar inicio="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Administración">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Panel Administrativo</h1>
                    <p class="page-subtitle">Visión general del sistema</p>
                </div>

            </div>
        </div>

        <!-- Pantalla de bienvenida administrador -->
        <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
            <div class="text-center">
                <h2 class="mb-3" style="color: var(--despegar-blue); font-weight: bold;">¡Bienvenido al Panel Administrativo!</h2>
                <p class="lead mb-4">Desde aquí puedes gestionar reservas, usuarios, pagos y toda la operación del sistema.<br>Utiliza el menú lateral para acceder a cada módulo.</p>
                <img src="https://cdn-icons-png.flaticon.com/512/2920/2920277.png" alt="Admin" width="120" class="mb-3" style="opacity:0.8;">
            </div>
        </div>
    </x-layouts.administracion.main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/sidebar.js')
</body>

</html>
