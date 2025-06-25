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
                'id' => 'nombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre del Paquete',
            ],
            (object) [
                'id' => 'duracion',
                'name' => 'duracion',
                'type' => 'number',
                'label' => 'Duracion del Paquete',
            ],
            (object) [
                'id' => 'ubicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion del Paquete',
            ],
            (object) [
                'id' => 'cupo_minimo',
                'name' => 'cupo_minimo',
                'type' => 'text',
                'label' => 'Cupo minimo de Personas',
            ],
            (object) [
                'id' => 'cupo_maximo',
                'name' => 'cupo_maximo',
                'type' => 'text',
                'label' => 'Cupo maximo de Personas',
            ],
            (object) [
                'id' => 'precio_total',
                'name' => 'precio_total',
                'type' => 'number',
                'label' => 'Precio total del Paquete',
            ],
            (object) [
                'id' => 'numero_paquete',
                'name' => 'numero_paquete',
                'type' => 'text',
                'label' => 'Codigo del Paquete',
            ],
            (object) [
                'id' => 'descripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Paquete',
            ],
            (object) [
                'id' => 'activo',
                'name' => 'activo',
                'type' => 'checkbox',
                'label' => 'Paquete Disponible',
            ],
        ];
        $camposEditar = [
            (object) [
                'id' => 'editNombre',
                'name' => 'nombre',
                'type' => 'text',
                'label' => 'Nombre del Paquete',
            ],
            (object) [
                'id' => 'editDuracion',
                'name' => 'duracion',
                'type' => 'number',
                'label' => 'Duracion del Paquete',
            ],
            (object) [
                'id' => 'editUbicacion',
                'name' => 'ubicacion',
                'type' => 'text',
                'label' => 'Ubicacion del Paquete',
            ],
            (object) [
                'id' => 'editCupoMinimo',
                'name' => 'cupo_minimo',
                'type' => 'text',
                'label' => 'Cupo minimo de Personas',
            ],
            (object) [
                'id' => 'editCupoMaximo',
                'name' => 'cupo_maximo',
                'type' => 'text',
                'label' => 'Cupo maximo de Personas',
            ],
            (object) [
                'id' => 'editPrecioTotal',
                'name' => 'precio_total',
                'type' => 'number',
                'label' => 'Precio total del Paquete',
            ],
            (object) [
                'id' => 'editNumeroPaquete',
                'name' => 'numero_paquete',
                'type' => 'text',
                'label' => 'Codigo del Paquete',
            ],
            (object) [
                'id' => 'editDescripcion',
                'name' => 'descripcion',
                'type' => 'text',
                'label' => 'Descripcion del Paquete',
            ],
            (object) [
                'id' => 'editActivo',
                'name' => 'activo',
                'type' => 'checkbox',
                'label' => 'Paquete Disponible',
            ],
        ];

        $camposBuscar = [
            (object) [
                'label' => 'Buscar Paquete',
                'type' => 'text',
                'name' => 'search_paquete',
                'id' => 'searchPaquete',
                'placeholder' => 'Nombre o codigo de paquete',
                'value' => 'search_paquete',
            ],
            (object) [
                'label' => 'Duracion',
                'type' => 'number',
                'name' => 'search_duracion',
                'id' => 'searchDuracion',
                'placeholder' => 'Duracion del Paquete',
                'value' => 'search_duracion',
            ],
            (object) [
                'label' => 'Ubicacion',
                'type' => 'text',
                'name' => 'search_ubicacion',
                'id' => 'searchUbicacion',
                'placeholder' => 'Ubicacion del Paquete',
                'value' => 'search_ubicacion',
            ],
            (object) [
                'label' => 'Precio',
                'type' => 'number',
                'name' => 'search_precio_total',
                'id' => 'searchPrecio_total',
                'placeholder' => 'Precio del Paquete',
                'value' => 'search_precio_total',
            ],
            (object) [
                'label' => 'Minimo de Personas',
                'type' => 'number',
                'name' => 'search_cupo_minimo',
                'id' => 'searchCupo_minimo',
                'placeholder' => 'Cupo minimo de personas',
                'value' => 'search_cupo_minimo',
            ],
            (object) [
                'label' => 'Maximo de Personas',
                'type' => 'number',
                'name' => 'search_cupo_maximo',
                'id' => 'searchCupo_maximo',
                'placeholder' => 'Cupo maximo de personas',
                'value' => 'search_cupo_maximo',
            ],
            (object) [
                'label' => 'Descripcion',
                'type' => 'text',
                'name' => 'search_descripcion',
                'id' => 'searchDescripcion',
                'placeholder' => 'Descripcion del paquete',
                'value' => 'search_descripcion',
            ],
            (object) [
                'label' => 'Hecho por',
                'type' => 'select',
                'name' => 'search_hecho_por_usuario',
                'id' => 'searchHecho_por_usuario',
                'value' => 'search_hecho_por_usuario',
                'options' => [
                    (object) ['value' => '0', 'text' => 'Empleado'],
                    (object) ['value' => '1', 'text' => 'Usuario'],
                ],
            ],
            (object) [
                'label' => 'Hospedaje Activo',
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
            $tHead = ['Nombre', 'Duracion', 'Ubicacion', 'Precio', 'Cupos', 'Creador', 'descripcion', 'Activo'];
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
