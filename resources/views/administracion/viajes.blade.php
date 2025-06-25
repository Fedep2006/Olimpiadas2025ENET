<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Administración de Viajes</title>

</head>

<body>
    @php
        $camposCrear = [
            (object) [
                'id' => 'nombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre del Viaje',
            ],
            (object) [
                'id' => 'tipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Viaje',
                'options' => [
                    (object) ['value' => 'avion', 'text' => 'Avion'],
                    (object) ['value' => 'bus', 'text' => 'Bus'],
                    (object) ['value' => 'tren', 'text' => 'Tren'],
                    (object) ['value' => 'crucero', 'text' => 'Crucero'],
                ],
            ],
            (object) [
                'id' => 'empresa_id',
                'name' => 'empresa_id',
                'type' => 'select',
                'label' => 'Empresa del Viaje',
                'options' => $empresas
                    ->map(function ($empresa) {
                        return (object) ['value' => $empresa->id, 'text' => $empresa->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'pais_id',
                'name' => 'pais_id',
                'type' => 'select',
                'label' => 'Pais',
                'options' => $paises
                    ->map(function ($pais) {
                        return (object) ['value' => $pais->id, 'text' => $pais->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'provincia_id',
                'name' => 'provincia_id',
                'type' => 'select',
                'label' => 'Provincia',
                'options' => $provincias
                    ->map(function ($provincia) {
                        return (object) ['value' => $provincia->id, 'text' => $provincia->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'ubicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion donde esta el Viaje',
            ],
            (object) [
                'id' => 'origen',
                'name' => 'origen',
                'type' => 'select',
                'label' => 'Ciudad de Origen',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'destino',
                'name' => 'destino',
                'type' => 'select',
                'label' => 'Ciudad de Destino',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'fecha_salida',
                'name' => 'fecha_salida',
                'type' => 'datetime-local',
                'label' => 'Fecha de Salida',
            ],
            (object) [
                'id' => 'fecha_llegada',
                'name' => 'fecha_llegada',
                'type' => 'datetime-local',
                'label' => 'Fecha de Llegada',
            ],
            (object) [
                'id' => 'numero_viaje',
                'name' => 'numero_viaje',
                'type' => 'number',
                'label' => 'Codigo del Viaje',
            ],
            (object) [
                'id' => 'capacidad_total',
                'name' => 'capacidad_total',
                'type' => 'number',
                'label' => 'Capacidad del Viaje',
            ],
            (object) [
                'id' => 'asientos_disponibles',
                'name' => 'asientos_disponibles',
                'type' => 'number',
                'label' => 'Asientos Disponibles',
            ],
            (object) [
                'id' => 'precio_base',
                'name' => 'precio_base',
                'type' => 'number',
                'label' => 'Precio del Viaje',
            ],
            (object) [
                'id' => 'descripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Viaje',
            ],
            (object) [
                'id' => 'activo',
                'name' => 'activo',
                'type' => 'checkbox',
                'label' => 'Viaje Disponible',
            ],
        ];
        $camposEditar = [
            (object) [
                'id' => 'editNombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre del Viaje',
            ],
            (object) [
                'id' => 'editTipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Viaje',
                'options' => [
                    (object) ['value' => 'avion', 'text' => 'Avion'],
                    (object) ['value' => 'bus', 'text' => 'Bus'],
                    (object) ['value' => 'tren', 'text' => 'Tren'],
                    (object) ['value' => 'crucero', 'text' => 'Crucero'],
                ],
            ],
            (object) [
                'id' => 'editEmpresaId',
                'name' => 'empresa_id',
                'type' => 'select',
                'label' => 'Empresa del Viaje',
                'options' => $empresas
                    ->map(function ($empresa) {
                        return (object) ['value' => $empresa->id, 'text' => $empresa->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'editPaisId',
                'name' => 'pais_id',
                'type' => 'select',
                'label' => 'Pais',
                'options' => $paises
                    ->map(function ($pais) {
                        return (object) ['value' => $pais->id, 'text' => $pais->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'editProvinciaId',
                'name' => 'provincia_id',
                'type' => 'select',
                'label' => 'Provincia',
                'options' => $provincias
                    ->map(function ($provincia) {
                        return (object) ['value' => $provincia->id, 'text' => $provincia->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'editUbicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion donde esta el Viaje',
            ],
            (object) [
                'id' => 'editOrigen',
                'name' => 'origen',
                'type' => 'select',
                'label' => 'Ciudad de Origen',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'editDestino',
                'name' => 'destino',
                'type' => 'select',
                'label' => 'Ciudad de Destino',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'editFechaSalida',
                'name' => 'fecha_salida',
                'type' => 'datetime-local',
                'label' => 'Fecha de Salida',
            ],
            (object) [
                'id' => 'editFechaLlegada',
                'name' => 'fecha_llegada',
                'type' => 'datetime-local',
                'label' => 'Fecha de Llegada',
            ],
            (object) [
                'id' => 'editNumeroViaje',
                'name' => 'numero_viaje',
                'type' => 'text',
                'label' => 'Codigo del Viaje',
            ],
            (object) [
                'id' => 'editCapacidadTotal',
                'name' => 'capacidad_total',
                'type' => 'text',
                'label' => 'Capacidad del Viaje',
            ],
            (object) [
                'id' => 'editAsientosDisponibles',
                'name' => 'asientos_disponibles',
                'type' => 'number',
                'label' => 'Asientos Disponibles',
            ],
            (object) [
                'id' => 'editPrecioBase',
                'name' => 'precio_base',
                'type' => 'number',
                'label' => 'Precio del Viaje',
            ],
            (object) [
                'id' => 'editDescripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Viaje',
            ],
            (object) [
                'id' => 'editActivo',
                'name' => 'activo',
                'type' => 'checkbox',
                'label' => 'Viaje Disponible',
            ],
        ];

        $camposBuscar = [
            (object) [
                'label' => 'Viaje',
                'type' => 'text',
                'name' => 'search_avion',
                'id' => 'searchAvion',
                'placeholder' => 'Numero o tipo de Viaje',
                'value' => 'search_avion',
            ],
            (object) [
                'label' => 'Nombre',
                'type' => 'text',
                'name' => 'search_nombre',
                'id' => 'searchNombre',
                'placeholder' => 'Nombre del Viaje',
                'value' => 'search_nombre',
            ],
            (object) [
                'id' => 'searchEmpresa_id',
                'name' => 'search_empresa_id',
                'type' => 'select',
                'label' => 'Empresa del Viaje',
                'value' => 'search_empresa_id',
                'options' => $empresas
                    ->map(function ($empresa) {
                        return (object) ['value' => $empresa->id, 'text' => $empresa->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'searchPais_id',
                'name' => 'search_pais_id',
                'type' => 'select',
                'label' => 'Pais',
                'value' => 'search_pais_id',
                'options' => $paises
                    ->map(function ($pais) {
                        return (object) ['value' => $pais->id, 'text' => $pais->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'searchProvincia_id',
                'name' => 'search_provincia_id',
                'type' => 'select',
                'label' => 'Provincia',
                'value' => 'search_provincia_id',
                'options' => $provincias
                    ->map(function ($provincia) {
                        return (object) ['value' => $provincia->id, 'text' => $provincia->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'searchOrigen',
                'name' => 'search_origen',
                'type' => 'select',
                'label' => 'Ciudad de Origen',
                'value' => 'search_origen',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'searchDestino',
                'name' => 'search_destino',
                'type' => 'select',
                'label' => 'Ciudad de Destino',
                'value' => 'search_destino',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'label' => 'Ubicacion',
                'type' => 'text',
                'name' => 'search_ubicacion',
                'id' => 'searchUbicacion',
                'value' => 'search_ubicacion',
                'placeholder' => 'Ubicacion',
            ],
            (object) [
                'label' => 'Fecha de Salida',
                'type' => 'datetime-local',
                'name' => 'search_fecha_salida',
                'id' => 'searchFecha_salida',
                'value' => 'search_fecha_salida',
            ],
            (object) [
                'label' => 'Fecha de Llegada',
                'type' => 'datetime-local',
                'name' => 'search_fecha_llegada',
                'id' => 'searchFecha_llegada',
                'value' => 'search_fecha_llegada',
            ],
            (object) [
                'label' => 'Asientos Disponibles',
                'type' => 'number',
                'name' => 'search_asientos_disponibles',
                'id' => 'searchAsientos_disponibles',
                'placeholder' => 'Asiento',
                'value' => 'search_asientos_disponibles',
            ],
            (object) [
                'label' => 'Capacidad Total',
                'type' => 'number',
                'name' => 'search_capacidad_total',
                'id' => 'searchCapacidad_total',
                'placeholder' => 'Capacidad',
                'value' => 'search_capacidad_total',
            ],
            (object) [
                'label' => 'Precio',
                'type' => 'number',
                'name' => 'search_precio',
                'id' => 'searchPrecio',
                'placeholder' => 'Precio',
                'value' => 'search_precio',
            ],
            (object) [
                'label' => 'Descripcion',
                'type' => 'text',
                'name' => 'search_descripcion',
                'id' => 'searchDescripcion',
                'placeholder' => 'Texto',
                'value' => 'search_descripcion',
            ],
            (object) [
                'label' => 'Viaje Activo',
                'type' => 'select',
                'name' => 'search_activo',
                'id' => 'searchActivo',
                'value' => 'search_activo',
                'options' => [
                    (object) ['value' => '1', 'text' => 'Activo'],
                    (object) ['value' => '0', 'text' => 'Inactivo'],
                ],
            ],
        ];
    @endphp
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar viajes="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Viajes">

        <x-layouts.administracion.page-header titulo="Gestion de Viajes"
            contenido="Administra todos los viajes disponibles" botonIcono="fas fa-plus" botonNombre="Nuevo Viaje" />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar" />

        <!-- Tabla de viajes -->
        @php
            $tHead = [
                'Viaje', //aca ira el numero_viaje, tipo e ID
                'Nombre',
                'Camino', //origen y destino van a estar en el mismo lugar
                'Ubicacion',
                'Fechas',
                'Empresa',
                'Capacidad', // disponibles/capacidad
                'Precio',
                'Estado',
                'Descripcion',
                //"Estado" el estado va a determinar si esta gris o no
            ];
        @endphp
        @include('administracion.partials.tabla', [
            'tHead' => $tHead,
            'nombre' => 'viajes',
        ])

    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals tituloCrear="Crear Nuevo Viaje" tituloEditar="Modificar Viaje"
        tituloEliminar="Eliminar Viaje" :camposCrear="$camposCrear" :camposEditar="$camposEditar" />
    <!-- Toast Notifications -->
    <x-layouts.administracion.modals.toast />

    @vite('resources/js/sidebar.js')
    @vite('resources/js/administracion/search-bar.js')
    @vite('resources/js/administracion/paginacion.js')
</body>

</html>
