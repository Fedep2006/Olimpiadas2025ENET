<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Empleados - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [
            (object)[
                'id' => 'usuario_id',
                'name' => 'usuario_id',
                'type' => 'number',
                'label' => 'ID del Usuario Asociado'
            ],
            (object)[
                'id' => 'puesto',
                'name' => 'puesto',
                'type' => 'text',
                'label' => 'Puesto'
            ],
            (object)[
                'id' => 'fecha_contratacion',
                'name' => 'fecha_contratacion',
                'type' => 'date',
                'label' => 'Fecha de Contratacion'
            ],
            (object)[
                'id' => 'salario',
                'name' => 'salario',
                'type' => 'number',
                'label' => 'Salario',
                'step' => '.01'
            ],
            (object)[
                'id' => 'estado',
                'name' => 'estado',
                'type' => 'select',
                'label' => 'Estado',
                'options' => [
                    (object)['value' => 'activo', 'text' => 'Activo'],
                    (object)['value' => 'inactivo', 'text' => 'Inactivo'],
                    (object)['value' => 'vacaciones', 'text' => 'Vacaciones'],
                    (object)['value' => 'licencia', 'text' => 'Licencia'],
                ],
            ]
        ];
        $camposEditar = [
            (object)[
                'id' => 'editPuesto',
                'name' => 'puesto',
                'type' => 'text',
                'label' => 'Puesto'
            ],
            (object)[
                'id' => 'editFecha_contratacion',
                'name' => 'fecha_contratacion',
                'type' => 'date',
                'label' => 'Fecha de Contratacion'
            ],
            (object)[
                'id' => 'editSalario',
                'name' => 'salario',
                'type' => 'number',
                'label' => 'Salario',
                'step' => '.01'
            ],
            (object)[
                'id' => 'editEstado',
                'name' => 'estado',
                'type' => 'select',
                'label' => 'Estado',
                'options' => [
                    (object)['value' => 'activo', 'text' => 'Activo'],
                    (object)['value' => 'inactivo', 'text' => 'Inactivo'],
                    (object)['value' => 'vacaciones', 'text' => 'Vacaciones'],
                    (object)['value' => 'licencia', 'text' => 'Licencia'],
                ],
            ],
        ];

        $camposBuscar = [
            (object)[
                'label' => 'ID del Empleado',
                'type' => 'text',
                'name' => 'search_id',
                'id' => 'searchId',
                'placeholder' => 'ID',
                'value' => 'search_id'
            ],
            (object)[
                'label' => 'Empleado',
                'type' => 'text',
                'name' => 'search_empleado',
                'id' => 'searchUsuario',
                'placeholder' => 'Usuario o email',
                'value' => 'search_usuario'
            ],
            (object)[
                'label' => 'Puesto',
                'type' => 'text',
                'name' => 'search_puesto',
                'id' => 'searchPuesto',
                'placeholder' => 'Puesto',
                'value' => 'search_puesto'
            ],
            (object)[
                'label' => 'Salario',
                'type' => 'number',
                'name' => 'search_salario',
                'id' => 'searchSalario',
                'placeholder' => 'Salario',
                'value' => 'search_salario'
            ],
            (object)[
                'label' => 'Estado',
                'type' => 'select',
                'name' => 'search_estado',
                'id' => 'searchEstado',
                'value' => 'search_estado',
                'options' => [
                    (object)['value' => 'activo', 'text' => 'Activo'],
                    (object)['value' => 'inactivo', 'text' => 'Inactivo'],
                    (object)['value' => 'vacaciones', 'text' => 'Vacaciones'],
                    (object)['value' => 'licencia', 'text' => 'Licencia'],
                ],
            ],
            (object)[
                'label' => 'Fecha de Contratacion',
                'type' => 'date',
                'name' => 'search_hiring_date',
                'id' => 'searchHiringDate',
                'value' => 'search_hiring_date'
            ]
        ]
        
    @endphp
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar empleados="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Empleados">
        
        <!-- Page Header -->
        <x-layouts.administracion.page-header 
            titulo="Gestion de Empleados" 
            contenido="Administra y gestiona los empleados"
            botonIcono="fas fa-user-plus" 
            botonNombre="Nuevo Empleado" 
        />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar"/>

        <!-- Tabla de empleados -->
        @php
            $tHead= [
                "Usuario",
                "Email",
                "Puesto",
                "Salario",
                "Estado",
                "Fecha de Contratacion",
            ];
        @endphp
        @include('administracion.partials.tabla', 
                [
                    'tHead' => $tHead,
                    'nombre' => 'empleados'
                ])

    </x-layouts.administracion.main>

    <!-- ABM Modals -->
    <x-layouts.administracion.modals.modals 
        tituloCrear="Crear Nuevo Empleado"
        tituloEditar="Modificar Empleado"
        tituloEliminar="Eliminar Empleado"
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
