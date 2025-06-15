<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Empleados - Frategar Admin</title>
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
                'placeholder' => 'ID del empleado',
                'value' => 'search_id'
            ],
            (object)[
                'label' => 'Buscar Empleado',
                'type' => 'text',
                'name' => 'search_empleado',
                'id' => 'searchUsuario',
                'placeholder' => 'Nombre de usuario o email',
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
    <x-layouts.administracion.sidebar empleados="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Empleados">
        
        <!-- Page Header -->
        <x-layouts.administracion.page-header 
            titulo="Gestion de Empleados" 
            contenido="Administra y gestiona los empleados"
            botonIcono="fas fa-user-plus" 
            botonNombre="Nuevo Empleado" 
        />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar"/>

        <!-- Tabla de empleados -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite('resources/js/sidebar.js')
</body>

</html>
