<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Usuarios - Frategar Admin</title>
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
            botonNombre="Nuevo Usuario" 
        />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar />

        <!-- Users Table -->
        @include('administracion.partials.tabla')
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals />

    <!-- Toast Notifications -->
    <x-layouts.administracion.modals.toast />

    @vite('resources/js/sidebar.js')
    @vite('resources/js/administracion/search-bar.js')
    @vite('resources/js/administracion/paginacion.js')
</body>

</html>
