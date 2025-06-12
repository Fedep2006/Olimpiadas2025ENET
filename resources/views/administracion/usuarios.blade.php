<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Usuarios - Frategar Admin</title>
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

        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1060;
        }

        .toast {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 300px;
        }

        .toast.success {
            border-left: 4px solid #28a745;
        }

        .toast.error {
            border-left: 4px solid #dc3545;
        }

        .toast-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 0.75rem 1rem;
        }

        .toast-body {
            padding: 1rem;
        }

        .pagination {
            display: flex;
            gap: 4px;
            align-items: center;
            margin: 0;
            padding: 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination .page-item {
            list-style: none;
            margin: 0;
        }

        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 8px;
            border-radius: 6px;
            border: 1px solid #e9ecef;
            background-color: white;
            color: var(--despegar-blue);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .pagination .page-link:hover {
            background-color: var(--despegar-light-blue);
            border-color: var(--despegar-blue);
            transform: translateY(-1px);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--despegar-blue);
            border-color: var(--despegar-blue);
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0 15px;
            text-align: center;
        }

        .pagination .page-link i {
            font-size: 0.8rem;
        }

        .pagination .page-link.prev,
        .pagination .page-link.next {
            padding: 0 12px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            min-width: 100px;
            height: 36px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .pagination .page-link.prev i,
        .pagination .page-link.next i {
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1em;
            height: 1em;
            line-height: 1;
        }

        .pagination .page-link.prev span,
        .pagination .page-link.next span {
            display: inline-flex;
            align-items: center;
            line-height: 1;
        }

        .pagination .page-item.disabled .page-link.prev,
        .pagination .page-item.disabled .page-link.next {
            background-color: #f8f9fa;
            border-color: #e9ecef;
            color: #6c757d;
            cursor: not-allowed;
            opacity: 0.65;
        }

        .pagination .page-item.disabled .page-link.prev i,
        .pagination .page-item.disabled .page-link.next i {
            opacity: 0.65;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar usuarios="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Usuarios">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestión de Usuarios</h1>
                    <p class="page-subtitle">Administra todos los usuarios registrados en el sistema</p>
                </div>
                <button class="btn-admin orange">
                    <i class="fas fa-user-plus"></i>
                    Nuevo Usuario
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="content-card">
            <div class="search-filters">
                <form id="searchForm" class="filter-row">
                    <div class="filter-group">
                        <label class="form-label">Buscar Usuario</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" id="searchInput"
                                placeholder="Nombre, email o ID de usuario" value="{{ request('search') }}"
                                autocomplete="off">
                            <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Fecha de Registro</label>
                        <input type="date" class="form-control" name="registration_date"
                            value="{{ request('registration_date') }}">
                    </div>
                    <div class="filter-group">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-admin">
                                <i class="fas fa-search"></i>
                                Buscar
                            </button>
                            <button type="button" class="btn-admin" style="background-color: #6c757d;"
                                id="clearFilters">
                                <i class="fas fa-times"></i>
                                Limpiar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Lista de Usuarios</h5>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @include('administracion.partials.users-table')
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="pagination-info">
                    @if ($users->total() > 0)
                        Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }}
                        usuarios
                    @else
                        No hay usuarios para mostrar
                    @endif
                </div>
                <div class="pagination-container">
                    @include('administracion.partials.pagination')
                </div>
            </div>
        </div>
    </x-layouts.administracion.main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <x-layouts.administracion.modals.modals />

    <!-- Toast Container -->
    <div class="toast-container"></div>

    @vite('resources/js/sidebar.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Wait for DOM to be fully loaded
            setTimeout(function() {

                // Function to show toast notification
                function showToast(message, type = 'success') {
                    const toastContainer = document.querySelector('.toast-container');
                    const toast = document.createElement('div');
                    toast.className = `toast ${type} show`;
                    toast.innerHTML = `
                        <div class="toast-header">
                            <strong class="me-auto">${type === 'success' ? 'Éxito' : 'Error'}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    `;
                    toastContainer.appendChild(toast);

                    // Remove toast after 3 seconds
                    setTimeout(() => {
                        toast.remove();
                    }, 3000);
                }

                // Search functionality
                let searchTimeout;
                const searchInput = document.getElementById('searchInput');
                const clearSearchBtn = document.getElementById('clearSearch');
                const dateInput = document.querySelector('input[name="registration_date"]');

                // Function to perform search
                function performSearch() {
                    const formData = new FormData(document.getElementById('searchForm'));
                    const searchParams = new URLSearchParams(formData);

                    fetch(`/usuarios?${searchParams.toString()}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            updateTable(data);
                            window.history.pushState({}, '', `/usuarios?${searchParams.toString()}`);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast('Error al buscar usuarios', 'error');
                        });
                }

                // Real-time search with debounce
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(performSearch, 500);
                });

                // Date input change handler
                dateInput.addEventListener('change', function() {
                    performSearch();
                });

                // Clear search input
                clearSearchBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    performSearch();
                });

                // Handle form submission
                document.getElementById('searchForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    performSearch();
                });

                // Clear all filters
                document.getElementById('clearFilters').addEventListener('click', function() {
                    document.getElementById('searchForm').reset();
                    window.location.href = '/usuarios';
                });

                // Handle pagination clicks
                document.addEventListener('click', function(e) {
                    const paginationLink = e.target.closest('.pagination a');
                    if (paginationLink) {
                        e.preventDefault();
                        e.stopPropagation();

                        const url = paginationLink.href;

                        fetch(url, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                updateTable(data);
                                window.history.pushState({}, '', url);
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showToast('Error al cargar la página', 'error');
                            });
                    }
                });



            }, 100);
        });
    </script>
</body>

</html>
