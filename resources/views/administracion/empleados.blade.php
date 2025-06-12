<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Empleados - Frategar Admin</title>
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

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-pending {
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

        .action-btn.message {
            background-color: #28a745;
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

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-profile-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--despegar-light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .user-info h6 {
            margin: 0;
            font-weight: bold;
        }

        .user-info small {
            color: #6c757d;
        }

        .role-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .role-admin {
            background-color: #dc3545;
            color: white;
        }

        .role-user {
            background-color: #007bff;
            color: white;
        }

        .role-premium {
            background-color: #ffc107;
            color: #212529;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-layouts.administracion.sidebar empleados="active" />
    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Empleados">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestión de Usuarios</h1>
                    <p class="page-subtitle">Administra todos los usuarios registrados en el sistema</p>
                </div>
                <a href="#" class="btn-admin orange">
                    <i class="fas fa-user-plus"></i>
                    Nuevo Usuario
                </a>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-number">3,891</div>
                <div class="stat-label">Total Usuarios</div>
            </div>
            <div class="stat-card" style="border-left-color: #28a745;">
                <div class="stat-number">3,654</div>
                <div class="stat-label">Usuarios Activos</div>
            </div>
            <div class="stat-card" style="border-left-color: #ffc107;">
                <div class="stat-number">892</div>
                <div class="stat-label">Usuarios Premium</div>
            </div>
            <div class="stat-card" style="border-left-color: #dc3545;">
                <div class="stat-number">237</div>
                <div class="stat-label">Usuarios Inactivos</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="content-card">
            <div class="search-filters">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="form-label">Buscar Usuario</label>
                        <input type="text" class="form-control" placeholder="Nombre, email o ID de usuario">
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Estado</label>
                        <select class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                            <option value="pending">Pendiente</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Tipo de Usuario</label>
                        <select class="form-select">
                            <option value="">Todos los tipos</option>
                            <option value="user">Usuario Regular</option>
                            <option value="premium">Usuario Premium</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Fecha de Registro</label>
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

        <!-- Users Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Lista de Empleados</h5>
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
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            <th>Fecha Registro</th>
                            <th>Última Actividad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-profile">
                                    <div class="user-profile-avatar">MP</div>
                                    <div class="user-info">
                                        <h6>María Pérez</h6>
                                        <small>ID: #USR-001</small>
                                    </div>
                                </div>
                            </td>
                            <td>maria.perez@email.com</td>
                            <td>+54 11 1234-5678</td>
                            <td><span class="role-badge role-premium">Premium</span></td>
                            <td>15 Ene 2024</td>
                            <td>Hace 2 horas</td>
                            <td><span class="status-badge status-active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver perfil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn message" title="Enviar mensaje">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button class="action-btn delete" title="Desactivar">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-profile">
                                    <div class="user-profile-avatar">CG</div>
                                    <div class="user-info">
                                        <h6>Carlos García</h6>
                                        <small>ID: #USR-002</small>
                                    </div>
                                </div>
                            </td>
                            <td>carlos.garcia@email.com</td>
                            <td>+54 11 2345-6789</td>
                            <td><span class="role-badge role-user">Usuario</span></td>
                            <td>20 Ene 2024</td>
                            <td>Hace 1 día</td>
                            <td><span class="status-badge status-active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver perfil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn message" title="Enviar mensaje">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button class="action-btn delete" title="Desactivar">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-profile">
                                    <div class="user-profile-avatar">AL</div>
                                    <div class="user-info">
                                        <h6>Ana López</h6>
                                        <small>ID: #USR-003</small>
                                    </div>
                                </div>
                            </td>
                            <td>ana.lopez@email.com</td>
                            <td>+54 11 3456-7890</td>
                            <td><span class="role-badge role-user">Usuario</span></td>
                            <td>25 Ene 2024</td>
                            <td>Hace 3 días</td>
                            <td><span class="status-badge status-inactive">Inactivo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver perfil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn message" title="Enviar mensaje">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button class="action-btn delete" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-profile">
                                    <div class="user-profile-avatar">JR</div>
                                    <div class="user-info">
                                        <h6>José Rodríguez</h6>
                                        <small>ID: #USR-004</small>
                                    </div>
                                </div>
                            </td>
                            <td>jose.rodriguez@email.com</td>
                            <td>+54 11 4567-8901</td>
                            <td><span class="role-badge role-admin">Admin</span></td>
                            <td>10 Ene 2024</td>
                            <td>Hace 30 min</td>
                            <td><span class="status-badge status-active">Activo</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver perfil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn message" title="Enviar mensaje">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-profile">
                                    <div class="user-profile-avatar">LM</div>
                                    <div class="user-info">
                                        <h6>Laura Martínez</h6>
                                        <small>ID: #USR-005</small>
                                    </div>
                                </div>
                            </td>
                            <td>laura.martinez@email.com</td>
                            <td>+54 11 5678-9012</td>
                            <td><span class="role-badge role-premium">Premium</span></td>
                            <td>05 Feb 2024</td>
                            <td>Hace 5 horas</td>
                            <td><span class="status-badge status-pending">Pendiente</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="Ver perfil">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn message" title="Enviar mensaje">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button class="action-btn delete" title="Activar">
                                        <i class="fas fa-check"></i>
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
    </x-layouts.administracion.main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/sidebar.js')
</body>

</html>
