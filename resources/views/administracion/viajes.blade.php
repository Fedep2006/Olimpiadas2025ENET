<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Administración de Viajes</title>

</head>

<body>
        @php
        $camposCrear = [
            (object)[
                'id' => 'nombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre del Viaje'
            ],
            (object)[
                'id' => 'tipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Viaje',
                'options' => [
                    (object)['value' => 'avion', 'text' => 'Avion'],
                    (object)['value' => 'bus', 'text' => 'Bus'],
                    (object)['value' => 'tren', 'text' => 'Tren'],
                    (object)['value' => 'crucero', 'text' => 'Crucero'],
                ],
            ],
            (object)[
                'id' => 'origen',
                'name' => 'origen',
                'type' => 'text',
                'label' => 'Ciudad de Origen'
            ],
            (object)[
                'id' => 'destino',
                'name' => 'destino',
                'type' => 'text',
                'label' => 'Ciudad de Destino'
            ],
            (object)[
                'id' => 'fecha_salida',
                'name' => 'fecha_salida',
                'type' => 'datetime-local',
                'label' => 'Fecha de Salida'
            ],
            (object)[
                'id' => 'fecha_llegada',
                'name' => 'fecha_llegada',
                'type' => 'datetime-local',
                'label' => 'Fecha de Llegada'
            ],
            (object)[
                'id' => 'empresa',
                'name' => 'empresa',
                'type' => 'text',
                'label' => 'Empresa del Viaje'
            ],
            (object)[
                'id' => 'numero_viaje',
                'name' => 'numero_viaje',
                'type' => 'number',
                'label' => 'Codigo del Viaje'
            ],
            (object)[
                'id' => 'capacidad_total',
                'name' => 'capacidad_total',
                'type' => 'number',
                'label' => 'Capacidad del Viaje'
            ],
            (object)[
                'id' => 'asientos_disponibles',
                'name' => 'asientos_disponibles',
                'type' => 'number',
                'label' => 'Asientos Disponibles'
            ],
            (object)[
                'id' => 'precio_base',
                'name' => 'precio_base',
                'type' => 'number',
                'label' => 'Precio del Viaje'
            ],
            (object)[
                'id' => 'clases',
                'name' => 'clases',
                'type' => 'select',
                'label' => 'Clases',
                'options' => [
                    (object)['value' => 'economica', 'text' => 'Economica'],
                    (object)['value' => 'business', 'text' => 'Business'],
                    (object)['value' => 'primera', 'text' => 'Primera'],
                ],
            ],
            (object)[
                'id' => 'descripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Viaje',
            ],
            (object)[
                'id' => 'activo',
                'name' => 'activo',
                'type' => 'checkbox',
                'label' => 'Viaje Disponible',
            ]
        ];
        $camposEditar = [
            (object)[
                'id' => 'editNombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre del Viaje'
            ],
            (object)[
                'id' => 'editTipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Viaje',
                'options' => [
                    (object)['value' => 'avion', 'text' => 'Avion'],
                    (object)['value' => 'bus', 'text' => 'Bus'],
                    (object)['value' => 'tren', 'text' => 'Tren'],
                    (object)['value' => 'crucero', 'text' => 'Crucero'],
                ],
            ],
            (object)[
                'id' => 'editOrigen',
                'name' => 'origen',
                'type' => 'text',
                'label' => 'Ciudad de Origen'
            ],
            (object)[
                'id' => 'editDestino',
                'name' => 'destino',
                'type' => 'text',
                'label' => 'Ciudad de Destino'
            ],
            (object)[
                'id' => 'editFecha_salida',
                'name' => 'fecha_salida',
                'type' => 'datetime-local',
                'label' => 'Fecha de Salida'
            ],
            (object)[
                'id' => 'editFecha_llegada',
                'name' => 'fecha_llegada',
                'type' => 'datetime-local',
                'label' => 'Fecha de Llegada'
            ],
            (object)[
                'id' => 'editEmpresa',
                'name' => 'empresa',
                'type' => 'text',
                'label' => 'Empresa del Viaje'
            ],
            (object)[
                'id' => 'editNumero_viaje',
                'name' => 'numero_viaje',
                'type' => 'text',
                'label' => 'Codigo del Viaje'
            ],
            (object)[
                'id' => 'editCapacidad_total',
                'name' => 'capacidad_total',
                'type' => 'text',
                'label' => 'Capacidad del Viaje'
            ],
            (object)[
                'id' => 'editPrecio_base',
                'name' => 'precio_base',
                'type' => 'number',
                'label' => 'Precio del Viaje'
            ],
            (object)[
                'id' => 'editClases',
                'name' => 'clases',
                'type' => 'select',
                'label' => 'Clases',
                'options' => [
                    (object)['value' => 'economica', 'text' => 'Economica'],
                    (object)['value' => 'business', 'text' => 'Business'],
                    (object)['value' => 'primera', 'text' => 'Primera'],
                ],
            ],
            (object)[
                'id' => 'editDescripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Viaje',
            ],
            (object)[
                'id' => 'editActivo',
                'name' => 'activo',
                'type' => 'checkbox',
                'label' => 'Viaje Disponible',
            ]
        ];

        $camposBuscar = [
            (object)[
                'label' => 'ID',
                'type' => 'text',
                'name' => 'search_id',
                'id' => 'searchId',
                'placeholder' => 'ID del Viaje',
                'value' => 'search_id'
            ],
            (object)[
                'label' => 'Viaje',
                'type' => 'text',
                'name' => 'search_avion',
                'id' => 'searchAvion',
                'placeholder' => 'Numero o tipo de Viaje',
                'value' => 'search_avion'
            ],
            (object)[
                'label' => 'Nombre',
                'type' => 'text',
                'name' => 'search_nombre',
                'id' => 'searchNombre',
                'placeholder' => 'Nombre del Viaje',
                'value' => 'search_nombre'
            ],
            (object)[
                'label' => 'Origen',
                'type' => 'text',
                'name' => 'search_origen',
                'id' => 'searchOrigen',
                'value' => 'search_origen'
            ],
            (object)[
                'label' => 'destino',
                'type' => 'text',
                'name' => 'search_destino',
                'id' => 'searchDestino',
                'value' => 'search_destino'
            ],
            (object)[
                'label' => 'Fecha de Salida',
                'type' => 'datetime-local',
                'name' => 'search_fecha_salida',
                'id' => 'searchFecha_salida',
                'value' => 'search_fecha_salida'
            ],
            (object)[
                'label' => 'Fecha de Llegada',
                'type' => 'datetime-local',
                'name' => 'search_fecha_llegada',
                'id' => 'searchFecha_llegada',
                'value' => 'search_fecha_llegada'
            ],
            (object)[
                'label' => 'Empresa',
                'type' => 'text',
                'name' => 'search_empresa',
                'id' => 'searchEmpresa',
                'placeholder' => 'Empresa',
                'value' => 'search_empresa'
            ],
            (object)[
                'label' => 'Capacidad Total',
                'type' => 'number',
                'name' => 'search_capacidad_total',
                'id' => 'searchCapacidad_total',
                'placeholder' => 'Capacidad',
                'value' => 'search_capacidad_total'
            ],
            (object)[
                'label' => 'Asientos Disponibles',
                'type' => 'number',
                'name' => 'search_asientos_disponibles',
                'id' => 'searchAsientos_disponibles',
                'placeholder' => 'Asiento',
                'value' => 'search_asientos_disponibles'
            ],
            (object)[
                'label' => 'Clases',
                'type' => 'select',
                'name' => 'search_clases',
                'id' => 'searchClases',
                'value' => 'search_clases',
                'options' => [
                    (object)['value' => 'economica', 'text' => 'Economica'],
                    (object)['value' => 'business', 'text' => 'Business'],
                    (object)['value' => 'primera', 'text' => 'Primera']
                ],
            ],
            (object)[
                'label' => 'Descripcion',
                'type' => 'text',
                'name' => 'search_descripcion',
                'id' => 'searchDescripcion',
                'value' => 'search_descripcion'
            ],
            (object)[
                'label' => 'Viaje Activo',
                'type' => 'checkbox',
                'name' => 'search_activo',
                'id' => 'searchActivo',
                'value' => 'search_activo'
            ]
        ]
        
    @endphp
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar viajes="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Viajes">

        <x-layouts.administracion.page-header 
            titulo="Gestion de Viajes" 
            contenido="Administra todos los viajes disponibles"
            botonIcono="fas fa-plus" 
            botonNombre="Nuevo Viaje" 
        />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar"/>

        <!-- Tabla de viajes -->
        @php
            $tHead= [
                "Viaje",//aca ira el numero_viaje, tipo e ID
                "Nombre",
                "Camino", //origen y destino van a estar en el mismo lugar
                "Fecha de Salida y Llegada",
                "Empresa",
                "Capacidad",// disponibles/capacidad
                "Precio",
                "Estado",
                "Descripcion"
                //"Estado" el estado va a determinar si esta gris o no
            ];
        @endphp
        @include('administracion.partials.tabla', 
                [
                    'tHead' => $tHead,
                    'nombre' => 'viajes'
                ])
        
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals 
        tituloCrear="Crear Nuevo Viaje"
        tituloEditar="Modificar Viaje"
        tituloEliminar="Eliminar Viaje"
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
