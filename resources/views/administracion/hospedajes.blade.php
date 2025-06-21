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
                'id' => 'ubicacion',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Ubicacion del Hospedaje'
            ],
            (object)[
                'id' => 'pais',
                'name' => 'pais',
                'type' => 'text',
                'label' => 'Pais del Hospedaje'
            ],
            (object)[
                'id' => 'ciudad',
                'name' => 'ciudad',
                'type' => 'text',
                'label' => 'Ciudad del Hospedaje'
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
                'label' => 'Calificacion del Hospedaje'
                'step' => '1',
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
                'label' => 'Nombre de la Empresa'
            ],
            (object)[
                'id' => 'editTipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Empresa',
                'options' => [
                    (object)['value' => 'hospedajes', 'text' => 'Hospedajes'],
                    (object)['value' => 'viajes', 'text' => 'Viajes'],
                ],
            ]
        ];
        
        $camposBuscar = [
            (object)[
                'label' => 'Buscar Empresa',
                'type' => 'text',
                'name' => 'search_empresa',
                'id' => 'searchEmpresa',
                'placeholder' => 'Nombre de la Empresa',
                'value' => 'search_empresa'
            ],
            (object)[
                'label' => 'Tipo de Empresa',
                'type' => 'select',
                'name' => 'search_tipo',
                'id' => 'searchTipo',
                'value' => 'search_tipo',
                'options' => [
                    (object)['value' => 'hospedajes', 'text' => 'Hospedajes'],
                    (object)['value' => 'viajes', 'text' => 'Viajes'],
                    (object)['value' => 'paquetes', 'text' => 'Paquetes'],
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
                "Tipo de Empresa",
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
