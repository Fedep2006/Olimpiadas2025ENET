<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Reservas - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [
            (object) [
                'id' => 'usuario_id',
                'name' => 'usuario_id',
                'type' => 'select',
                'label' => 'Usuario',
                'options' => $usuarios
                    ->map(function ($usuario) {
                        return (object) ['value' => $usuario->id, 'text' => $usuario->name];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'paquete_id',
                'name' => 'paquete_id',
                'type' => 'select',
                'label' => 'Paquete',
                'options' => $paquetes
                    ->map(function ($paquete) {
                        return (object) ['value' => $paquete->id, 'text' => $paquete->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'fecha_inicio',
                'name' => 'fecha_inicio',
                'type' => 'datetime-local',
                'label' => 'Fecha de Inicio',
            ],
            (object) [
                'id' => 'fecha_fin',
                'name' => 'fecha_fin',
                'type' => 'datetime-local',
                'label' => 'Fecha Final',
            ],
            (object) [
                'id' => 'precio_total',
                'name' => 'precio_total',
                'type' => 'number',
                'label' => 'Precio Total',
            ],
            (object) [
                'id' => 'codigo_reserva',
                'name' => 'codigo_reserva',
                'type' => 'text',
                'label' => 'Codigo de Reserva',
            ],
            (object) [
                'id' => 'estado',
                'name' => 'estado',
                'type' => 'select',
                'label' => 'Estado de la Reserva',
                'options' => [
                    (object) ['value' => 'pendiente', 'text' => 'Pendiente'],
                    (object) ['value' => 'confirmada', 'text' => 'Confirmada'],
                    (object) ['value' => 'cancelada', 'text' => 'Cancelada'],
                    (object) ['value' => 'completada', 'text' => 'Completada'],
                ],
            ],
        ];
        $camposEditar = [
            (object) [
                'id' => 'editUsuario_id',
                'name' => 'usuario_id',
                'type' => 'select',
                'label' => 'Usuario',
                'options' => $usuarios
                    ->map(function ($usuario) {
                        return (object) ['value' => $usuario->id, 'text' => $usuario->name];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'editPaquete_id',
                'name' => 'paquete_id',
                'type' => 'select',
                'label' => 'Paquete',
                'options' => $paquetes
                    ->map(function ($paquete) {
                        return (object) ['value' => $paquete->id, 'text' => $paquete->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'editFecha_inicio',
                'name' => 'fecha_inicio',
                'type' => 'date',
                'label' => 'Fecha de Inicio',
            ],
            (object) [
                'id' => 'editFecha_fin',
                'name' => 'fecha_fin',
                'type' => 'date',
                'label' => 'Fecha Final',
            ],
            (object) [
                'id' => 'editPrecio_total',
                'name' => 'precio_total',
                'type' => 'number',
                'label' => 'Precio Total',
            ],
            (object) [
                'id' => 'editCodigo_reserva',
                'name' => 'codigo_reserva',
                'type' => 'text',
                'label' => 'Codigo de Reserva',
            ],
            (object) [
                'id' => 'editEstado',
                'name' => 'estado',
                'type' => 'select',
                'label' => 'Estado de la Reserva',
                'options' => [
                    (object) ['value' => 'pendiente', 'text' => 'Pendiente'],
                    (object) ['value' => 'confirmada', 'text' => 'Confirmada'],
                    (object) ['value' => 'cancelada', 'text' => 'Cancelada'],
                    (object) ['value' => 'completada', 'text' => 'Completada'],
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
                'label' => 'fecha_inicio',
                'type' => 'date',
                'name' => 'search_fecha_inicio',
                'id' => 'searchFecha_inicio',
                'placeholder' => 'Fecha de Inicio',
                'value' => 'search_fecha_inicio',
            ],
            (object) [
                'label' => 'fecha_fin',
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
            botonIcono="fas fa-plus" botonNombre="Nuevo Reserva" />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar" />

        <!-- Users Table -->
        @php
            $tHead = ['Reserva', 'Usuario', 'Paquete', 'Fechas', 'Precio', 'Estado'];
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
