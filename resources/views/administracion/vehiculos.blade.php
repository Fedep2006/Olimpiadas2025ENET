<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Vehiculos - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [
            (object)[
                'id' => 'tipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Vehiculo',
                'options' => [
                    (object)['value' => 'auto', 'text' => 'Auto'],
                    (object)['value' => 'camioneta', 'text' => 'Camioneta'],
                    (object)['value' => 'moto', 'text' => 'Moto'],
                    (object)['value' => 'bicicleta', 'text' => 'Bicicleta'],
                ],
            ],
            (object)[
                'id' => 'marca',
                'name' => 'marca',
                'type' => 'text',
                'label' => 'Marca del Vehiculo'
            ],
            (object)[
                'id' => 'modelo',
                'name' => 'modelo',
                'type' => 'text',
                'label' => 'Modelo del Vehiculo'
            ],
            (object)[
                'id' => 'antiguedad',
                'name' => 'antiguedad',
                'type' => 'number',
                'label' => 'Año de Fabricacion'
            ],
            (object)[
                'id' => 'patente',
                'name' => 'patente',
                'type' => 'text',
                'label' => 'Patente del Vehiculo'
            ],
            (object)[
                'id' => 'color',
                'name' => 'color',
                'type' => 'text',
                'label' => 'Color del Vehiculo'
            ],
            (object)[
                'id' => 'capacidad_pasajeros',
                'name' => 'capacidad_pasajeros',
                'type' => 'number',
                'label' => 'Capacidad de Pasajeros'
            ],
            (object)[
                'id' => 'pais',
                'name' => 'pais',
                'type' => 'text',
                'label' => 'Pais donde se encuentra el Vehiculo'
            ],
            (object)[
                'id' => 'ciudad',
                'name' => 'ciudad',
                'type' => 'text',
                'label' => 'Ciudad donde se encuentra el Vehiculo'
            ],
            (object)[
                'id' => 'ubicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion del Vehiculo'
            ],
            (object)[
                'id' => 'precio_por_dia',
                'name' => 'precio_por_dia',
                'type' => 'number',
                'label' => 'Precio por dia',
                'step' => '0.01'
            ],
            (object)[
                'id' => 'descripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Vehiculo'
            ],
            (object)[
                'id' => 'disponible',
                'name' => 'disponible',
                'type' => 'checkbox',
                'label' => 'Vehiculo Disponible',
            ]
        ];
        $camposEditar = [
            (object)[
                'id' => 'editTipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Vehiculo',
                'options' => [
                    (object)['value' => 'auto', 'text' => 'Auto'],
                    (object)['value' => 'camioneta', 'text' => 'Camioneta'],
                    (object)['value' => 'moto', 'text' => 'Moto'],
                    (object)['value' => 'bicicleta', 'text' => 'Bicicleta'],
                ],
            ],
            (object)[
                'id' => 'editMarca',
                'name' => 'marca',
                'type' => 'text',
                'label' => 'Marca del Vehiculo'
            ],
            (object)[
                'id' => 'editModelo',
                'name' => 'editModelo',
                'type' => 'text',
                'label' => 'Modelo del Vehiculo'
            ],
            (object)[
                'id' => 'editAntiguedad',
                'name' => 'antiguedad',
                'type' => 'number',
                'label' => 'Año de Fabricacion'
            ],
            (object)[
                'id' => 'editPatente',
                'name' => 'patente',
                'type' => 'text',
                'label' => 'Patente del Vehiculo'
            ],
            (object)[
                'id' => 'editColor',
                'name' => 'color',
                'type' => 'text',
                'label' => 'Color del Vehiculo'
            ],
            (object)[
                'id' => 'editCapacidad_pasajeros',
                'name' => 'capacidad_pasajeros',
                'type' => 'number',
                'label' => 'Capacidad de Pasajeros'
            ],
            (object)[
                'id' => 'editPais',
                'name' => 'pais',
                'type' => 'text',
                'label' => 'Pais donde se encuentra el Vehiculo'
            ],
            (object)[
                'id' => 'editCiudad',
                'name' => 'ciudad',
                'type' => 'text',
                'label' => 'Ciudad donde se encuentra el Vehiculo'
            ],
            (object)[
                'id' => 'editUbicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion del Vehiculo'
            ],
            (object)[
                'id' => 'editPrecio_por_dia',
                'name' => 'precio_por_dia',
                'type' => 'number',
                'label' => 'Precio por dia',
                'step' => '0.01'
            ],
            (object)[
                'id' => 'editDescripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Vehiculo'
            ],
            (object)[
                'id' => 'editDisponible',
                'name' => 'disponible',
                'type' => 'checkbox',
                'label' => 'Vehiculo Disponible',
            ]
        ];
        
        $camposBuscar = [
            (object)[
                'label' => 'Vehiculo',
                'type' => 'text',
                'name' => 'search_vehiculo',
                'id' => 'searchVehiculo',
                'placeholder' => 'Nombre del vehiculo',
                'value' => 'search_vehiculo'
            ],
            (object)[
                'label' => 'Tipo de Hospedaje',
                'type' => 'select',
                'name' => 'search_tipo',
                'id' => 'searchTipo',
                'value' => 'search_tipo',
                'options' => [
                    (object)['value' => 'hotel', 'text' => 'Hotel'],
                    (object)['value' => 'hostal', 'text' => 'Hostal'],
                    (object)['value' => 'apartamento', 'text' => 'Apartamento'],
                    (object)['value' => 'casa', 'text' => 'Casa'],
                    (object)['value' => 'cabaña', 'text' => 'Cabaña'],
                    (object)['value' => 'resort', 'text' => 'Resort'],
                ],
            ],
            (object)[
                'id' => 'searchHabitacion',
                'name' => 'search_habitacion',
                'type' => 'select',
                'label' => 'Tipo de Habitacion',
                'value' => 'search_habitacion',
                'options' => [
                    (object)['value' => 'individual', 'text' => 'Individual'],
                    (object)['value' => 'doble', 'text' => 'Doble'],
                    (object)['value' => 'triple', 'text' => 'Triple'],
                    (object)['value' => 'cuadruple', 'text' => 'Cuadruple'],
                    (object)['value' => 'suite', 'text' => 'Suite'],
                    (object)['value' => 'familiar', 'text' => 'Familiar'],
                ],
            ],
            (object)[
                'label' => 'Maximo de Personas',
                'type' => 'number',
                'name' => 'search_maximo_personas',
                'id' => 'searchMaximo_personas',
                'placeholder' => 'Maximo de personas',
                'value' => 'search_maximo_personas'
            ],
            (object)[
                'label' => 'Hospedajes Disponibles',
                'type' => 'number',
                'name' => 'search_hospedajes_disponibles',
                'id' => 'searchHospedajes_disponibles',
                'placeholder' => 'Hospedajes Disponibles',
                'value' => 'search_hospedajes_disponibles',
            ],
            (object)[
                'label' => 'Precio',
                'type' => 'number',
                'name' => 'search_precio',
                'id' => 'searchPrecio',
                'placeholder' => 'Precio del hospedaje',
                'value' => 'search_precio',
            ],
            (object)[
                'label' => 'Ubicacion',
                'type' => 'text',
                'name' => 'search_ubicacion',
                'id' => 'searchUbicacion',
                'placeholder' => 'Ubicacion del hospedaje',
                'value' => 'search_ubicacion',
            ],
            (object)[
                'id' => 'searchCalificacion',
                'name' => 'search_calificacion',
                'type' => 'number',
                'label' => 'Calificacion',
                'value' => 'search_calificacion',
                'min' => '0.1',
                'step' => '0.1',
                'max' => '5',
                'placeholder' => 'Calificacion o Estrellas',
            ],
            (object)[
                'label' => 'Descripcion',
                'type' => 'text',
                'name' => 'search_descripcion',
                'id' => 'searchDescripcion',
                'placeholder' => 'Texto',
                'value' => 'search_descripcion'
            ],
            (object)[
                'label' => 'Check-in',
                'type' => 'time',
                'name' => 'search_check_in',
                'id' => 'searchCheck_in',
                'placeholder' => 'Hora de entrada',
                'value' => 'search_check_in'
            ],
            (object)[
                'label' => 'Check-out',
                'type' => 'time',
                'name' => 'search_check_out',
                'id' => 'searchCheck_out',
                'placeholder' => 'Hora de salida',
                'value' => 'search_check_out'
            ],
            (object)[
                'label' => 'Contacto',
                'type' => 'text',
                'name' => 'search_contacto',
                'id' => 'searchContacto',
                'placeholder' => 'Email, sitio web o telefono',
                'value' => 'search_contacto'
            ],
            (object)[
                'label' => 'Condiciones',
                'type' => 'text',
                'name' => 'search_condiciones',
                'id' => 'searchCondiciones',
                'placeholder' => 'Condiciones del hospedaje',
                'value' => 'search_condiciones'
            ],
            (object)[
                'label' => 'Hospedaje Activo',
                'type' => 'select',
                'name' => 'search_activo',
                'id' => 'searchActivo',
                'value' => 'search_activo',
                'options' => [
                    (object)['value' => '1', 'text' => 'Activo'],
                    (object)['value' => '0', 'text' => 'Inactivo'],
                ],
            ]
        ];
        
    @endphp
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar vehiculos="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Vehiculo">
                <!-- Page Header -->
        <x-layouts.administracion.page-header 
            titulo="Gestion de Vehiculo" 
            contenido="Administra y gestiona los vehiculos"
            botonIcono="fas fa-plus" 
            botonNombre="Nuevo Vehiculo" 
        />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar"/>

        <!-- Users Table -->
        @php
            $tHead= [
                "Vehiculo", //tipo de vehiculo, marca y modelo
                "Patente", //patente y antiguedad
                "Capacidad",
                "precio",
                "Ubicacion",
                "Lugar",
                "Descripcion", //descripcion y color
                "Disponible",

            ];
        @endphp
        @include('administracion.partials.tabla', 
                [
                    'tHead' => $tHead,
                    'nombre' => 'vehiculos'
                ])
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals 
        tituloCrear="Crear Nuevo Vehiculo"
        tituloEditar="Modificar Vehiculo"
        tituloEliminar="Eliminar Vehiculo"
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
