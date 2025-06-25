<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Vehiculos - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [
            (object) [
                'id' => 'tipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Vehiculo',
                'options' => [
                    (object) ['value' => 'auto', 'text' => 'Auto'],
                    (object) ['value' => 'camioneta', 'text' => 'Camioneta'],
                    (object) ['value' => 'moto', 'text' => 'Moto'],
                    (object) ['value' => 'bicicleta', 'text' => 'Bicicleta'],
                ],
            ],
            (object) [
                'id' => 'marca',
                'name' => 'marca',
                'type' => 'text',
                'label' => 'Marca del Vehiculo',
            ],
            (object) [
                'id' => 'modelo',
                'name' => 'modelo',
                'type' => 'text',
                'label' => 'Modelo del Vehiculo',
            ],
            (object) [
                'id' => 'antiguedad',
                'name' => 'antiguedad',
                'type' => 'number',
                'label' => 'Año de Fabricacion',
            ],
            (object) [
                'id' => 'patente',
                'name' => 'patente',
                'type' => 'text',
                'label' => 'Patente del Vehiculo',
            ],
            (object) [
                'id' => 'color',
                'name' => 'color',
                'type' => 'text',
                'label' => 'Color del Vehiculo',
            ],
            (object) [
                'id' => 'vehiculos_disponibles',
                'name' => 'vehiculos_disponibles',
                'type' => 'number',
                'label' => 'Vehiculos Disponibles',
            ],
            (object) [
                'id' => 'capacidad_pasajeros',
                'name' => 'capacidad_pasajeros',
                'type' => 'number',
                'label' => 'Capacidad de Pasajeros',
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
                'id' => 'ciudad_id',
                'name' => 'ciudad_id',
                'type' => 'select',
                'label' => 'Ciudad',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'ubicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion donde esta el Vehiculo',
            ],
            (object) [
                'id' => 'precio_por_dia',
                'name' => 'precio_por_dia',
                'type' => 'number',
                'label' => 'Precio por dia',
                'step' => '0.01',
            ],
            (object) [
                'id' => 'descripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Vehiculo',
            ],
            (object) [
                'id' => 'disponible',
                'name' => 'disponible',
                'type' => 'checkbox',
                'label' => 'Vehiculo Disponible',
            ],
        ];
        $camposEditar = [
            (object) [
                'id' => 'editTipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Vehiculo',
                'options' => [
                    (object) ['value' => 'auto', 'text' => 'Auto'],
                    (object) ['value' => 'camioneta', 'text' => 'Camioneta'],
                    (object) ['value' => 'moto', 'text' => 'Moto'],
                    (object) ['value' => 'bicicleta', 'text' => 'Bicicleta'],
                ],
            ],
            (object) [
                'id' => 'editMarca',
                'name' => 'marca',
                'type' => 'text',
                'label' => 'Marca del Vehiculo',
            ],
            (object) [
                'id' => 'editModelo',
                'name' => 'modelo',
                'type' => 'text',
                'label' => 'Modelo del Vehiculo',
            ],
            (object) [
                'id' => 'editAntiguedad',
                'name' => 'antiguedad',
                'type' => 'number',
                'label' => 'Año de Fabricacion',
            ],
            (object) [
                'id' => 'editPatente',
                'name' => 'patente',
                'type' => 'text',
                'label' => 'Patente del Vehiculo',
            ],
            (object) [
                'id' => 'editColor',
                'name' => 'color',
                'type' => 'text',
                'label' => 'Color del Vehiculo',
            ],
            (object) [
                'id' => 'editVehiculosDisponibles',
                'name' => 'vehiculos_disponibles',
                'type' => 'number',
                'label' => 'Vehiculos Disponibles',
            ],
            (object) [
                'id' => 'editCapacidadPasajeros',
                'name' => 'capacidad_pasajeros',
                'type' => 'number',
                'label' => 'Capacidad de Pasajeros',
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
                'id' => 'editCiudadId',
                'name' => 'ciudad_id',
                'type' => 'select',
                'label' => 'Ciudad',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'editUbicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion donde esta el Vehiculo',
            ],
            (object) [
                'id' => 'editPrecioPorDia',
                'name' => 'precio_por_dia',
                'type' => 'number',
                'label' => 'Precio por dia',
                'step' => '0.01',
            ],
            (object) [
                'id' => 'editDescripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Vehiculo',
            ],
            (object) [
                'id' => 'editDisponible',
                'name' => 'disponible',
                'type' => 'checkbox',
                'label' => 'Vehiculo Disponible',
            ],
        ];

        $camposBuscar = [
            (object) [
                'id' => 'searchTipo',
                'name' => 'search_tipo',
                'type' => 'select',
                'label' => 'Tipo de Vehiculo',
                'value' => 'search_tipo',
                'placeholder' => 'Tipo de vehiculo',
                'options' => [
                    (object) ['value' => 'auto', 'text' => 'Auto'],
                    (object) ['value' => 'camioneta', 'text' => 'Camioneta'],
                    (object) ['value' => 'moto', 'text' => 'Moto'],
                    (object) ['value' => 'bicicleta', 'text' => 'Bicicleta'],
                ],
            ],
            (object) [
                'id' => 'searchMarca',
                'name' => 'search_marca',
                'type' => 'text',
                'label' => 'Marca del Vehiculo',
                'value' => 'search_marca',
                'placeholder' => 'Marca del vehiculo',
            ],
            (object) [
                'id' => 'searchModelo',
                'name' => 'search_modelo',
                'type' => 'text',
                'label' => 'Modelo del Vehiculo',
                'value' => 'search_modelo',
                'placeholder' => 'Modelo del vehiculo',
            ],
            (object) [
                'id' => 'searchAntiguedad',
                'name' => 'search_antiguedad',
                'type' => 'number',
                'label' => 'Año de Fabricacion',
                'value' => 'search_antiguedad',
                'placeholder' => 'Antiguedad del vehiculo',
            ],
            (object) [
                'id' => 'searchPatente',
                'name' => 'search_patente',
                'type' => 'text',
                'label' => 'Patente del Vehiculo',
                'value' => 'search_patente',
                'placeholder' => 'Patente del vehiculo',
            ],
            (object) [
                'id' => 'searchColor',
                'name' => 'search_color',
                'type' => 'text',
                'label' => 'Color del Vehiculo',
                'value' => 'search_color',
                'placeholder' => 'Color del vehiculo',
            ],
            (object) [
                'id' => 'searchVehiculos_disponibles',
                'name' => 'search_vehiculos_disponibles',
                'type' => 'number',
                'label' => 'Vehiculos Disponibles',
                'value' => 'search_vehiculos_disponibles',
                'placeholder' => 'Cantidad de vehiculos',
            ],
            (object) [
                'id' => 'searchCapacidad_pasajeros',
                'name' => 'search_capacidad_pasajeros',
                'type' => 'number',
                'label' => 'Capacidad de Pasajeros',
                'value' => 'search_capacidad_pasajeros',
                'placeholder' => 'Cantidad de pasajeros',
            ],
            (object) [
                'id' => 'searchPais_id',
                'name' => 'search_pais_id',
                'type' => 'select',
                'label' => 'Pais',
                'value' => 'search_pais_id',
                'placeholder' => 'Pais',
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
                'placeholder' => 'Provincia',
                'options' => $provincias
                    ->map(function ($provincia) {
                        return (object) ['value' => $provincia->id, 'text' => $provincia->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'searchCiudad_id',
                'name' => 'search_ciudad_id',
                'type' => 'select',
                'label' => 'Ciudad',
                'value' => 'search_ciudad_id',
                'placeholder' => 'Ciudad',
                'options' => $ciudades
                    ->map(function ($ciudad) {
                        return (object) ['value' => $ciudad->id, 'text' => $ciudad->nombre];
                    })
                    ->toArray(),
            ],
            (object) [
                'id' => 'searchUbicacion',
                'name' => 'search_ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion donde esta el Vehiculo',
                'value' => 'search_ubicacion',
                'placeholder' => 'Ubicacion del vehiculo',
            ],
            (object) [
                'id' => 'searchPrecio_por_dia',
                'name' => 'search_precio_por_dia',
                'type' => 'number',
                'label' => 'Precio por dia',
                'step' => '0.01',
                'value' => 'search_precio_por_dia',
                'placeholder' => 'Precio por dia',
            ],
            (object) [
                'id' => 'searchDescripcion',
                'name' => 'search_descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Vehiculo',
                'value' => 'search_descripcion',
                'placeholder' => 'Descripcion',
            ],
            (object) [
                'id' => 'searchActivo',
                'name' => 'search_activo',
                'type' => 'select',
                'label' => 'Vehiculo Disponible',
                'value' => 'search_activo',
                'placeholder' => 'Disponibilidad',
                'options' => [
                    (object) ['value' => '1', 'text' => 'Activo'],
                    (object) ['value' => '0', 'text' => 'Inactivo'],
                ],
            ],
        ];
    @endphp
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar vehiculos="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Vehiculo">
        <!-- Page Header -->
        <x-layouts.administracion.page-header titulo="Gestion de Vehiculo" contenido="Administra y gestiona los vehiculos"
            botonIcono="fas fa-plus" botonNombre="Nuevo Vehiculo" />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar" />

        <!-- Users Table -->
        @php
            $tHead = [
                'Vehiculo', //tipo de vehiculo, marca y modelo
                'Caracteristicas',
                'Patente', //patente y antiguedad
                'Precio',
                'Ubicacion',
                'Lugar',
                'Descripcion', //descripcion y color
                'Disponible',
            ];
        @endphp
        @include('administracion.partials.tabla', [
            'tHead' => $tHead,
            'nombre' => 'vehiculos',
        ])
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals tituloCrear="Crear Nuevo Vehiculo" tituloEditar="Modificar Vehiculo"
        tituloEliminar="Eliminar Vehiculo" :camposCrear="$camposCrear" :camposEditar="$camposEditar" />
    <!-- Toast Notifications -->
    <x-layouts.administracion.modals.toast />

    @vite('resources/js/sidebar.js')
    @vite('resources/js/administracion/search-bar.js')
    @vite('resources/js/administracion/paginacion.js')
</body>

</html>
