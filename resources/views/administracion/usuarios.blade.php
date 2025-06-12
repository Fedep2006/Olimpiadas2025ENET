<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Usuarios - Frategar Admin</title>
    <style>
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
        <x-layouts.administracion.page-header 
            titulo="Gestion de Usuarios" 
            contenido="Administra y gestiona los usuarios"
            botonIcono="fas fa-user-plus" 
            botonNombre="Nuevo Usuario" />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar />

        <!-- Users Table -->
        @include('administracion.partials.tabla')
    </x-layouts.administracion.main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <x-layouts.administracion.modals.modals />

    <!-- Toast Container -->
    <div class="toast-container"></div>

    @vite('resources/js/sidebar.js')
    @vite('resources/js/administracion/search-bar.js')
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
