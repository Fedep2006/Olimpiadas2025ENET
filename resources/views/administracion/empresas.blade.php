<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Empresas - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [
            (object)[
                'id' => 'nombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre de la Empresa'
            ],
            (object)[
                'id' => 'tipo',
                'name' => 'tipo',
                'type' => 'select',
                'label' => 'Tipo de Empresa',
                'options' => [
                    (object)['value' => 'hospedajes', 'text' => 'Hospedajes'],
                    (object)['value' => 'viajes', 'text' => 'Viajes'],
                ],
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
                ],
            ]
        ];
        
    @endphp
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar empresas="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Empresas">
                <!-- Page Header -->
        <x-layouts.administracion.page-header 
            titulo="Gestion de Empresas" 
            contenido="Administra y gestiona las empresas"
            botonIcono="fas fa-plus" 
            botonNombre="Nueva Empresa" 
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
                    'nombre' => 'empresas'
                ])
    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals 
        tituloCrear="Crear Nueva Empresa"
        tituloEditar="Modificar Empresa"
        tituloEliminar="Eliminar Empresa"
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
