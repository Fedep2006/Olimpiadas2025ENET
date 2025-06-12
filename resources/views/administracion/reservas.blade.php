<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Reservas - Frategar Admin</title>
    <style>
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

        .btn-admin.orange:hover {
            background-color: #e55a00;
        }

        .btn-admin.success {
            background-color: #28a745;
        }

        .btn-admin.danger {
            background-color: #dc3545;
        }

        .status-badge {
            padding: 6px 12px;
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

        .status-processing {
            background-color: #d1ecf1;
            color: #0c5460;
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

        .form-control:focus,
        .form-select:focus {
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            margin: 0;
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

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination .page-link {
            color: var(--despegar-blue);
            border-color: #dee2e6;
            padding: 10px 15px;
        }

        .pagination .page-link:hover {
            background-color: var(--despegar-light-blue);
            border-color: var(--despegar-blue);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--despegar-blue);
            border-color: var(--despegar-blue);
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
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-layouts.administracion.sidebar reservas="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Reservas">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestión de Reservas</h1>
                    <p class="page-subtitle">Administra todas las reservas del sistema</p>
                </div>
                <a href="#" class="btn-admin orange">
                    <i class="fas fa-plus"></i>
                    Nueva Reserva
                </a>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-number">1,247</div>
                <div class="stat-label">Total Reservas</div>
            </div>
            <div class="stat-card" style="border-left-color: var(--despegar-orange);">
                <div class="stat-number">892</div>
                <div class="stat-label">Confirmadas</div>
            </div>
            <div class="stat-card" style="border-left-color: #ffc107;">
                <div class="stat-number">234</div>
                <div class="stat-label">Pendientes</div>
            </div>
            <div class="stat-card" style="border-left-color: #dc3545;">
                <div class="stat-number">121</div>
                <div class="stat-label">Canceladas</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="content-card">
            <div class="search-filters">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="form-label">Buscar por ID o Cliente</label>
                        <input type="text" class="form-control"
                            placeholder="Ingresa ID de reserva o nombre del cliente">
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Estado</label>
                        <select class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="confirmed">Confirmada</option>
                            <option value="pending">Pendiente</option>
                            <option value="cancelled">Cancelada</option>
                            <option value="processing">Procesando</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Fecha desde</label>
                        <input type="date" class="form-control" value="2024-03-01">
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Fecha hasta</label>
                        <input type="date" class="form-control" value="2024-03-31">
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

        <!-- Reservations Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Lista de Reservas</h5>
                <div class="d-flex gap-2">
                    <a href="#" class="btn-admin success">
                        <i class="fas fa-file-excel"></i>
                        Excel
                    </a>
                </div>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Reserva</th>
                            <th>Cliente</th>
                            <th>Tipo</th>
                            <th>Destino</th>
                            <th>Fecha Viaje</th>
                            <th>Fecha Reserva</th>
                            <th>Monto</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>#FR-12847</strong></td>
                            <td>
                                <div>
                                    <strong>María Pérez</strong><br>
                                    <small class="text-muted">maria.perez@email.com</small>
                                </div>
                            </td>
                            <td><span class="badge bg-primary">Vuelo</span></td>
                            <td>Buenos Aires → Miami</td>
                            <td>15 Mar 2024</td>
                            <td>10 Mar 2024</td>
                            <td><strong>$1,299</strong></td>
                            <td><span class="status-badge status-confirmed">Confirmada</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" title="Cancelar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#FR-12846</strong></td>
                            <td>
                                <div>
                                    <strong>Carlos García</strong><br>
                                    <small class="text-muted">carlos.garcia@email.com</small>
                                </div>
                            </td>
                            <td><span class="badge bg-success">Paquete</span></td>
                            <td>París, Francia</td>
                            <td>18 Mar 2024</td>
                            <td>12 Mar 2024</td>
                            <td><strong>$2,150</strong></td>
                            <td><span class="status-badge status-pending">Pendiente</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" title="Cancelar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#FR-12845</strong></td>
                            <td>
                                <div>
                                    <strong>Ana López</strong><br>
                                    <small class="text-muted">ana.lopez@email.com</small>
                                </div>
                            </td>
                            <td><span class="badge bg-info">Hotel</span></td>
                            <td>Cancún, México</td>
                            <td>20 Mar 2024</td>
                            <td>08 Mar 2024</td>
                            <td><strong>$899</strong></td>
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
                            <td><strong>#FR-12844</strong></td>
                            <td>
                                <div>
                                    <strong>José Rodríguez</strong><br>
                                    <small class="text-muted">jose.rodriguez@email.com</small>
                                </div>
                            </td>
                            <td><span class="badge bg-warning">Auto</span></td>
                            <td>Nueva York, NY</td>
                            <td>22 Mar 2024</td>
                            <td>14 Mar 2024</td>
                            <td><strong>$1,750</strong></td>
                            <td><span class="status-badge status-processing">Procesando</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" title="Cancelar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>#FR-12843</strong></td>
                            <td>
                                <div>
                                    <strong>Laura Martínez</strong><br>
                                    <small class="text-muted">laura.martinez@email.com</small>
                                </div>
                            </td>
                            <td><span class="badge bg-primary">Vuelo</span></td>
                            <td>Madrid, España</td>
                            <td>25 Mar 2024</td>
                            <td>16 Mar 2024</td>
                            <td><strong>$1,450</strong></td>
                            <td><span class="status-badge status-confirmed">Confirmada</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" title="Cancelar">
                                        <i class="fas fa-times"></i>
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
                        <a class="page-link" href="#">4</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">5</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </x-layouts.administracion.main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @vite('resources/js/sidebar.js')
</body>

</html>
