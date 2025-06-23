<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Hospedajes - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [
            (object)[
                'id' => 'nombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre del Hospedaje'
            ],
            (object)[
                'id' => 'empresa_id',
                'name' => 'empresa_id',
                'type' => 'select',
                'label' => 'Empresa del Hospedaje',
                'options' => $empresas->map(function($empresa) {
                    return (object)['value' => $empresa->id, 'text' => $empresa->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'tipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Hospedaje',
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
                'id' => 'habitacion',
                'name' => 'habitacion',
                'type' => 'select',
                'label' => 'Tipo de Habitacion',
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
                'id' => 'habitaciones_disponibles',
                'name' => 'habitaciones_disponibles',
                'type' => 'number',
                'label' => 'Habitaciones Disponibles'
            ],
            (object)[
                'id' => 'capacidad_personas',
                'name' => 'capacidad_personas',
                'type' => 'number',
                'label' => 'Capacidad de Personas'
            ],
            (object)[
                'id' => 'precio_por_noche',
                'name' => 'precio_por_noche',
                'type' => 'number',
                'label' => 'Precio por Noche'
            ],
            (object)[
                'id' => 'pais_id',
                'name' => 'pais_id',
                'type' => 'select',
                'label' => 'Pais',
                'options' => $paises->map(function($pais) {
                    return (object)['value' => $pais->id, 'text' => $pais->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'provincia_id',
                'name' => 'provincia_id',
                'type' => 'select',
                'label' => 'Provincia',
                'options' => $provincias->map(function($provincia) {
                    return (object)['value' => $provincia->id, 'text' => $provincia->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'ciudad_id',
                'name' => 'ciudad_id',
                'type' => 'select',
                'label' => 'Ciudad',
                'options' => $ciudades->map(function($ciudad) {
                    return (object)['value' => $ciudad->id, 'text' => $ciudad->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'ubicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion donde esta el Hospedaje',
            ],
            (object)[
                'id' => 'estrellas',
                'name' => 'estrellas',
                'type' => 'number',
                'label' => 'Estrellas del Hospedaje'
            ],
            (object)[
                'id' => 'descripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Hospedaje'
            ],
            (object)[
                'id' => 'telefono',
                'name' => 'telefono',
                'type' => 'number',
                'label' => 'Telefono del Hospedaje'
            ],
            (object)[
                'id' => 'email',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email del Hospedaje'
            ],
            (object)[
                'id' => 'sitio_web',
                'name' => 'sitio_web',
                'type' => 'text',
                'label' => 'Sitio Web del Hospedaje'
            ],
            (object)[
                'id' => 'check_in',
                'name' => 'check_in',
                'type' => 'time',
                'label' => 'Check-in del Hospedaje'
            ],
            (object)[
                'id' => 'check_out',
                'name' => 'check_out',
                'type' => 'time',
                'label' => 'Check-out del Hospedaje'
            ],
            (object)[
                'id' => 'calificacion',
                'name' => 'calificacion',
                'type' => 'number',
                'label' => 'Calificacion del Hospedaje',
                'min' => '0.1',
                'step' => '0.1',
                'max' => '5',
            ],
            (object)[
                'id' => 'activo',
                'name' => 'activo',
                'type' => 'checkbox',
                'label' => 'Hospedaje Disponible',
            ],
            (object)[
                'id' => 'condiciones',
                'name' => 'condiciones',
                'type' => 'text',
                'label' => 'Condiciones del Hospedaje'
            ]
        ];
        $camposEditar = [
            (object)[
                'id' => 'editNombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre del Hospedaje'
            ],
            (object)[
                'id' => 'editEmpresa_id',
                'name' => 'empresa_id',
                'type' => 'select',
                'label' => 'Empresa del Hospedaje',
                'options' => $empresas->map(function($empresa) {
                    return (object)['value' => $empresa->id, 'text' => $empresa->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'editTipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Hospedaje',
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
                'id' => 'editHabitacion',
                'name' => 'habitacion',
                'type' => 'select',
                'label' => 'Tipo de Habitacion',
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
                'id' => 'editHabitaciones_disponibles',
                'name' => 'habitaciones_disponibles',
                'type' => 'number',
                'label' => 'Habitaciones Disponibles'
            ],
            (object)[
                'id' => 'editCapacidad_personas',
                'name' => 'capacidad_personas',
                'type' => 'number',
                'label' => 'Capacidad de Personas'
            ],
            (object)[
                'id' => 'editPrecio_por_noche',
                'name' => 'precio_por_noche',
                'type' => 'number',
                'label' => 'Precio por Noche'
            ],
            (object)[
                'id' => 'editPais_id',
                'name' => 'pais_id',
                'type' => 'select',
                'label' => 'Pais',
                'options' => $paises->map(function($pais) {
                    return (object)['value' => $pais->id, 'text' => $pais->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'editProvincia_id',
                'name' => 'provincia_id',
                'type' => 'select',
                'label' => 'Provincia',
                'options' => $provincias->map(function($provincia) {
                    return (object)['value' => $provincia->id, 'text' => $provincia->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'editCiudad_id',
                'name' => 'ciudad_id',
                'type' => 'select',
                'label' => 'Ciudad',
                'options' => $ciudades->map(function($ciudad) {
                    return (object)['value' => $ciudad->id, 'text' => $ciudad->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'editUbicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion donde esta el Hospedaje',
            ],
            (object)[
                'id' => 'editEstrellas',
                'name' => 'estrellas',
                'type' => 'number',
                'label' => 'Estrellas del Hospedaje'
            ],
            (object)[
                'id' => 'editDescripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Hospedaje'
            ],
            (object)[
                'id' => 'editTelefono',
                'name' => 'telefono',
                'type' => 'number',
                'label' => 'Telefono del Hospedaje'
            ],
            (object)[
                'id' => 'editEmail',
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email del Hospedaje'
            ],
            (object)[
                'id' => 'editSitio_web',
                'name' => 'sitio_web',
                'type' => 'text',
                'label' => 'Sitio Web del Hospedaje'
            ],
            (object)[
                'id' => 'editCheck_in',
                'name' => 'check_in',
                'type' => 'time',
                'label' => 'Check-in del Hospedaje'
            ],
            (object)[
                'id' => 'editCheck_out',
                'name' => 'check_out',
                'type' => 'time',
                'label' => 'Check-out del Hospedaje'
            ],
            (object)[
                'id' => 'editCalificacion',
                'name' => 'calificacion',
                'type' => 'number',
                'label' => 'Calificacion del Hospedaje',
                'min' => '0.1',
                'step' => '0.1',
                'max' => '5',
            ],
            (object)[
                'id' => 'editActivo',
                'name' => 'activo',
                'type' => 'checkbox',
                'label' => 'Hospedaje Disponible',
            ],
            (object)[
                'id' => 'editCondiciones',
                'name' => 'condiciones',
                'type' => 'text',
                'label' => 'Condiciones del Hospedaje'
            ]
        ];
        
        $camposBuscar = [
            (object)[
                'label' => 'Hospedaje',
                'type' => 'text',
                'name' => 'search_hospedaje',
                'id' => 'searchHospedaje',
                'placeholder' => 'Nombre del hospedaje',
                'value' => 'search_hospedaje'
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
                'id' => 'searchEmpresa_id',
                'name' => 'search_empresa_id',
                'type' => 'select',
                'label' => 'Empresa',
                'value' => 'search_empresa_id',
                'options' => $empresas->map(function($empresa) {
                    return (object)['value' => $empresa->id, 'text' => $empresa->nombre];
                })->toArray()
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
                'id' => 'searchPais_id',
                'name' => 'search_pais_id',
                'type' => 'select',
                'label' => 'Pais',
                'value' => 'search_pais_id',
                'options' => $paises->map(function($pais) {
                    return (object)['value' => $pais->id, 'text' => $pais->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'searchProvincia_id',
                'name' => 'search_provincia_id',
                'type' => 'select',
                'label' => 'Provincia',
                'value' => 'search_provincia_id',
                'options' => $provincias->map(function($provincia) {
                    return (object)['value' => $provincia->id, 'text' => $provincia->nombre];
                })->toArray()
            ],
            (object)[
                'id' => 'searchCiudad_id',
                'name' => 'search_ciudad_id',
                'type' => 'select',
                'label' => 'Ciudad',
                'value' => 'search_ciudad_id',
                'options' => $ciudades->map(function($ciudad) {
                    return (object)['value' => $ciudad->id, 'text' => $ciudad->nombre];
                })->toArray()
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
    <x-layouts.administracion.sidebar hospedajes="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Hospedajes">
                <!-- Page Header -->
        <x-layouts.administracion.page-header 
            titulo="Gestion de Hospedajes" 
            contenido="Administra y gestiona los hospedajes"
            botonIcono="fas fa-plus" 
            botonNombre="Nuevo Hospedaje" 
        />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar"/>

        <!-- Users Table -->
        @php
            $tHead= [
                "Nombre",
                "Empresa",
                "Habitacion",
                "Precio",
                "Ubicacion",
                "Lugar",
                "Calificacion",
                "descripcion",
                "Contacto",
                "Horarios",
                "condiciones",
                "activo",

            ];
        @endphp
        @include('administracion.partials.tabla', 
                [
                    'tHead' => $tHead,
                    'nombre' => 'hospedajes'
                ])
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals 
        tituloCrear="Crear Nuevo Hospedaje"
        tituloEditar="Modificar Hospedaje"
        tituloEliminar="Eliminar Hospedaje"
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
