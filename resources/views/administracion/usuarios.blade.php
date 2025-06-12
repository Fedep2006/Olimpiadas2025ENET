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
        @include('administracion.partials.tabla')
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
