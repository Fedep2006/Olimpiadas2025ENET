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
                'label' => 'Buscar ID',
                'type' => 'text',
                'name' => 'search_id',
                'id' => 'searchId',
                'placeholder' => 'ID de usuario',
                'value' => 'search_id'
            ],
            (object)[
                'label' => 'Buscar Usuario',
                'type' => 'text',
                'name' => 'search_usuario',
                'id' => 'searchUsuario',
                'placeholder' => 'Nombre o email del usuario',
                'value' => 'search_usuario'
            ],
            (object)[
                'label' => 'Fecha de Registro',
                'type' => 'date',
                'name' => 'search_registration_date',
                'id' => 'searchRegistrationDate',
                'value' => 'search_registration_date'
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
        @php
            $tHead= [
                "Usuario",
                "Email",
                "Fecha Registro",
            ];
        @endphp
        @include('administracion.partials.tabla', 
                [
                    'tHead' => $tHead,
                    'nombre' => 'usuarios'
                ])
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
