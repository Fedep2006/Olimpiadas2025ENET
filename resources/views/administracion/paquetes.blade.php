<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Paquetes - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [
            (object) [
                'id' => 'name',
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nombre de Usuario',
            ],
            (object) [
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
            ],
            (object) [
                'id' => 'botonContenido',
                'name' => 'contenido',
                'type' => 'button',
                'label' => 'Contenido del Paquete',
            ],
            (object) [
                'id' => 'password',
                'name' => 'password',
                'type' => 'password',
                'label' => 'Contraseña',
            ],
            (object) [
                'id' => 'passwordConfirmation',
                'name' => 'password_confirmation',
                'type' => 'password',
                'label' => 'Confirmar Contraseña',
            ],
            (object) [
                'id' => 'nivel',
                'name' => 'nivel',
                'type' => 'select',
                'label' => 'Nivel',
                'options' => [
                    (object) ['value' => 0, 'text' => 'Cliente'],
                    (object) ['value' => 1, 'text' => 'Empleado'],
                ],
            ],
        ];
        $camposEditar = [
            (object) [
                'id' => 'editName',
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nombre de Usuario',
            ],
            (object) [
                'id' => 'editEmail',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
            ],
            (object) [
                'id' => 'editNivel',
                'name' => 'nivel',
                'type' => 'select',
                'label' => 'Nivel',
                'options' => [
                    (object) ['value' => 0, 'text' => 'Cliente'],
                    (object) ['value' => 1, 'text' => 'Empleado'],
                ],
            ],
        ];

        $camposBuscar = [
            (object) [
                'label' => 'Buscar Usuario',
                'type' => 'text',
                'name' => 'search_usuario',
                'id' => 'searchUsuario',
                'placeholder' => 'Nombre o email del usuario',
                'value' => 'search_usuario',
            ],
            (object) [
                'label' => 'Fecha de Registro',
                'type' => 'date',
                'name' => 'search_registration_date',
                'id' => 'searchRegistrationDate',
                'value' => 'search_registration_date',
            ],
            (object) [
                'label' => 'Nivel del Usuario',
                'type' => 'select',
                'name' => 'search_nivel',
                'id' => 'searchNivel',
                'value' => 'search_nivel',
                'options' => [
                    (object) ['value' => 0, 'text' => 'Cliente'],
                    (object) ['value' => 1, 'text' => 'Empleado'],
                ],
            ],
        ];
    @endphp
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar paquetes="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Paquetes">

        <!-- Page Header -->
        <x-layouts.administracion.page-header titulo="Gestion de Paquetes" contenido="Administra y gestiona los paquetes"
            botonIcono="fas fa-plus" botonNombre="Nuevo Paquete" />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar" />

        <!-- Users Table -->
        @php
            $tHead = ['Usuario', 'Email', 'Fecha Registro', 'Nivel'];
        @endphp
        @include('administracion.partials.tabla', [
            'tHead' => $tHead,
            'nombre' => 'paquetes',
        ])
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals tituloCrear="Crear Nuevo Paquete" tituloEditar="Modificar Paquete"
        tituloEliminar="Eliminar Paquete" :camposCrear="$camposCrear" :camposEditar="$camposEditar" />
    <!-- Toast Notifications -->
    <x-layouts.administracion.modals.toast />

    @vite('resources/js/sidebar.js')
    @vite('resources/js/administracion/search-bar.js')
    @vite('resources/js/administracion/paginacion.js')
</body>

</html>
