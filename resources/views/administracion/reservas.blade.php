<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Reservas - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [];
        $camposEditar = [
            (object) [
                'id' => 'editEstado',
                'name' => 'estado',
                'type' => 'select',
                'label' => 'Estado de la Reserva',
                'options' => [
                    (object) ['value' => 'confirmada', 'text' => 'Confirmada'],
                    (object) ['value' => 'cancelada', 'text' => 'Cancelada'],
                ],
            ],
        ];

        $camposBuscar = [
            (object) [
                'label' => 'Reserva',
                'type' => 'text',
                'name' => 'search_reserva',
                'id' => 'searchReserva',
                'placeholder' => 'Codigo de paquete o reserva',
                'value' => 'search_reserva',
            ],
            (object) [
                'label' => 'Usuario',
                'type' => 'text',
                'name' => 'search_usuario',
                'id' => 'searchUsuario',
                'placeholder' => 'Usuario de la Reserva',
                'value' => 'search_usuario',
            ],
            (object) [
                'label' => 'fecha de Inicio',
                'type' => 'date',
                'name' => 'search_fecha_inicio',
                'id' => 'searchFecha_inicio',
                'placeholder' => 'Fecha de Inicio',
                'value' => 'search_fecha_inicio',
            ],
            (object) [
                'label' => 'fecha de Fin',
                'type' => 'date',
                'name' => 'search_fecha_fin',
                'id' => 'searchFecha_fin',
                'placeholder' => 'Fecha Final',
                'value' => 'search_fecha_fin',
            ],
            (object) [
                'label' => 'Precio',
                'type' => 'number',
                'name' => 'search_precio_total',
                'id' => 'searchPrecio_total',
                'placeholder' => 'Precio de la Reserva',
                'value' => 'search_precio_total',
            ],
            (object) [
                'id' => 'searchEstado',
                'name' => 'search_estado',
                'type' => 'select',
                'label' => 'Estado de la Reserva',
                'value' => 'search_estado',
                'options' => [
                    (object) ['value' => 'pendiente', 'text' => 'Pendiente'],
                    (object) ['value' => 'confirmada', 'text' => 'Confirmada'],
                    (object) ['value' => 'cancelada', 'text' => 'Cancelada'],
                    (object) ['value' => 'completada', 'text' => 'Completada'],
                ],
            ],
        ];
    @endphp
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar reservas="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Reservas">

        <!-- Page Header -->
        <x-layouts.administracion.page-header titulo="Gestion de Reservas" contenido="Administra y gestiona las reservas"
            botonIcono="fas fa-plus" />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar" />

        <!-- Users Table -->
        @php
            $tHead = ['Usuario', 'Reserva', 'Paquete', 'Fechas', 'Precio', 'Estado'];
        @endphp
        @include('administracion.partials.tabla', [
            'tHead' => $tHead,
            'nombre' => 'reservas',
        ])
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals tituloCrear="Crear Nuevo Reserva" tituloEditar="Modificar Reservas"
        tituloEliminar="Eliminar Reservas" :camposCrear="$camposCrear" :camposEditar="$camposEditar" />
    <!-- Toast Notifications -->
    <x-layouts.administracion.modals.toast />

    @vite('resources/js/sidebar.js')
    @vite('resources/js/administracion/search-bar.js')
    @vite('resources/js/administracion/paginacion.js')
</body>

</html>
