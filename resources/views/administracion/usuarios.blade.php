<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Usuarios - Frategar Admin</title>
</head>

<body>
        @php
        $camposCrear = [
            (object)[
                'id' => 'name',
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nombre de Usuario'
            ],
            (object)[
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email'
            ],
            (object)[
                'id' => 'password',
                'name' => 'password',
                'type' => 'password',
                'label' => 'Contraseña'
            ]
        ];
        $camposEditar = [
            (object)[
                'id' => 'editName',
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nombre de Usuario'
            ],
            (object)[
                'id' => 'editEmail',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email'
            ]
        ];

        $camposBuscar = [
            (object)[
                'label' => 'Buscar Usuario1',
                'type' => 'text',
                'name' => 'search1',
                'id' => 'searchInput1',
                'placeholder' => 'Nombre, email o ID de usuario1'
            ],
            (object)[
                'label' => 'Fecha de Registro1',
                'type' => 'date',
                'name' => 'registration_date1',
                'id' => 'registrationDate1'
            ]
        ]
        
    @endphp
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
        <x-layouts.administracion.search-bar :inputs="$camposBuscar"/>

        <!-- Users Table -->
        @include('administracion.partials.tabla')
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals 
        tituloCrear="Crear Nuevo Usuario"
        tituloEditar="Modificar Usuario"
        tituloEliminar="Eliminar Usuario"
        :camposCrear="$camposCrear"
        :camposEditar="$camposEditar"
    />
    <!-- Toast Notifications -->
    <x-layouts.administracion.modals.toast />

    @vite('resources/js/sidebar.js')
    @vite('resources/js/administracion/search-bar.js')
    @vite('resources/js/administracion/paginacion.js')
</body>

</html>
