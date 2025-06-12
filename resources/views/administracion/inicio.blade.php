<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Panel Administrativo - Frategar</title>
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

        .notification-badge {
            position: relative;
            color: var(--despegar-blue);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .notification-badge::after {
            content: '3';
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--despegar-orange);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--despegar-blue);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .stats-card.orange {
            border-left-color: var(--despegar-orange);
        }

        .stats-card.green {
            border-left-color: #28a745;
        }

        .stats-card.purple {
            border-left-color: #6f42c1;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--despegar-blue);
            margin-bottom: 5px;
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .stats-change {
            font-size: 0.8rem;
            font-weight: bold;
        }

        .stats-change.positive {
            color: #28a745;
        }

        .stats-change.negative {
            color: #dc3545;
        }

        .chart-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--despegar-blue);
        }

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

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .btn-admin {
            background-color: var(--despegar-blue);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-admin:hover {
            background-color: #0052a3;
            color: white;
            transform: translateY(-2px);
        }

        .btn-admin.orange {
            background-color: var(--despegar-orange);
        }

        .btn-admin.orange:hover {
            background-color: #e55a00;
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

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .action-btn.edit {
            background-color: #17a2b8;
            color: white;
        }

        .action-btn.delete {
            background-color: #dc3545;
            color: white;
        }

        .action-btn.view {
            background-color: #28a745;
            color: white;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .quick-action-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #e9ecef;
        }

        .quick-action-item:hover {
            background-color: var(--despegar-light-blue);
            border-color: var(--despegar-blue);
        }

        .quick-action-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
        }

        .recent-activity {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 0.9rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: var(--despegar-light-blue);
            color: var(--despegar-blue);
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-layouts.administracion.sidebar hospedajes="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Hospedajes">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stats-number">1,247</div>
                            <div class="stats-label">Reservas Totales</div>
                            <div class="stats-change positive">
                                <i class="fas fa-arrow-up"></i> +12.5%
                            </div>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card orange">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stats-number">$89,432</div>
                            <div class="stats-label">Ingresos del Mes</div>
                            <div class="stats-change positive">
                                <i class="fas fa-arrow-up"></i> +8.2%
                            </div>
                        </div>
                        <div style="color: var(--despegar-orange);">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card green">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stats-number">3,891</div>
                            <div class="stats-label">Usuarios Activos</div>
                            <div class="stats-change positive">
                                <i class="fas fa-arrow-up"></i> +15.3%
                            </div>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card purple">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stats-number">94.2%</div>
                            <div class="stats-label">Satisfacción</div>
                            <div class="stats-change negative">
                                <i class="fas fa-arrow-down"></i> -2.1%
                            </div>
                        </div>
                        <div style="color: #6f42c1;">
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">Ingresos Mensuales</h5>
                        <div class="dropdown">
                            <button class="btn btn-admin dropdown-toggle" data-bs-toggle="dropdown">
                                Últimos 6 meses
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Últimos 3 meses</a></li>
                                <li><a class="dropdown-item" href="#">Últimos 6 meses</a></li>
                                <li><a class="dropdown-item" href="#">Último año</a></li>
                            </ul>
                        </div>
                    </div>
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="quick-actions">
                    <h5 class="chart-title mb-4">Acciones Rápidas</h5>

                    <div class="quick-action-item" onclick="showModal('newReservation')">
                        <div class="quick-action-icon" style="background-color: var(--despegar-blue);">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Nueva Reserva</div>
                            <small class="text-muted">Crear reserva manual</small>
                        </div>
                    </div>

                    <div class="quick-action-item" onclick="showModal('newPromo')">
                        <div class="quick-action-icon" style="background-color: var(--despegar-orange);">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Nueva Promoción</div>
                            <small class="text-muted">Crear oferta especial</small>
                        </div>
                    </div>

                    <div class="quick-action-item" onclick="generateReport()">
                        <div class="quick-action-icon" style="background-color: #28a745;">
                            <i class="fas fa-file-export"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Exportar Reporte</div>
                            <small class="text-muted">Generar reporte PDF</small>
                        </div>
                    </div>

                    <div class="quick-action-item" onclick="sendNotification()">
                        <div class="quick-action-icon" style="background-color: #6f42c1;">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Enviar Notificación</div>
                            <small class="text-muted">Mensaje a usuarios</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reservations Table -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="data-table">
                    <div class="table-header d-flex justify-content-between align-items-center">
                        <h5 class="table-title">Reservas Recientes</h5>
                        <div class="table-actions">
                            <button class="btn btn-admin">
                                <i class="fas fa-filter me-2"></i>Filtrar
                            </button>
                            <button class="btn btn-admin orange">
                                <i class="fas fa-plus me-2"></i>Nueva Reserva
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Destino</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#12847</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2"
                                                style="width: 30px; height: 30px; font-size: 0.8rem;">MP</div>
                                            <div>
                                                <div class="fw-bold">María Pérez</div>
                                                <small class="text-muted">maria@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Miami, FL</td>
                                    <td>15 Mar 2024</td>
                                    <td>$1,299</td>
                                    <td><span class="status-badge status-confirmed">Confirmada</span></td>
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
                                <tr>
                                    <td>#12846</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2"
                                                style="width: 30px; height: 30px; font-size: 0.8rem;">CG</div>
                                            <div>
                                                <div class="fw-bold">Carlos García</div>
                                                <small class="text-muted">carlos@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>París, Francia</td>
                                    <td>18 Mar 2024</td>
                                    <td>$2,150</td>
                                    <td><span class="status-badge status-pending">Pendiente</span></td>
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
                                <tr>
                                    <td>#12845</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2"
                                                style="width: 30px; height: 30px; font-size: 0.8rem;">AL</div>
                                            <div>
                                                <div class="fw-bold">Ana López</div>
                                                <small class="text-muted">ana@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Cancún, México</td>
                                    <td>20 Mar 2024</td>
                                    <td>$899</td>
                                    <td><span class="status-badge status-cancelled">Cancelada</span></td>
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
                                <tr>
                                    <td>#12844</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2"
                                                style="width: 30px; height: 30px; font-size: 0.8rem;">JR</div>
                                            <div>
                                                <div class="fw-bold">José Rodríguez</div>
                                                <small class="text-muted">jose@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Nueva York, NY</td>
                                    <td>22 Mar 2024</td>
                                    <td>$1,750</td>
                                    <td><span class="status-badge status-confirmed">Confirmada</span></td>
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
                </div>
            </div>

            <div class="col-lg-4">
                <div class="recent-activity">
                    <h5 class="chart-title mb-4">Actividad Reciente</h5>

                    <div class="activity-item">
                        <div class="activity-icon" style="background-color: var(--despegar-blue); color: white;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <div class="fw-bold">Nuevo usuario registrado</div>
                            <div class="activity-time">Hace 5 minutos</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background-color: var(--despegar-orange); color: white;">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="activity-content">
                            <div class="fw-bold">Reserva confirmada #12847</div>
                            <div class="activity-time">Hace 12 minutos</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background-color: #28a745; color: white;">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="activity-content">
                            <div class="fw-bold">Pago recibido $1,299</div>
                            <div class="activity-time">Hace 25 minutos</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background-color: #6f42c1; color: white;">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="activity-content">
                            <div class="fw-bold">Nueva reseña 5 estrellas</div>
                            <div class="activity-time">Hace 1 hora</div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon" style="background-color: #dc3545; color: white;">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="activity-content">
                            <div class="fw-bold">Reserva cancelada #12845</div>
                            <div class="activity-time">Hace 2 horas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.administracion.main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
