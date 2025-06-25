<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Contenido de Paquetes - Frategar Admin</title>
</head>

<body>
    @php
        $camposCrear = [
            (object) [
                'id' => 'numero_paquete',
                'name' => 'numero_paquete',
                'type' => 'text',
                'label' => 'Codigo de Paquete',
            ],
            (object) [
                'id' => 'contenido_type',
                'name' => 'contenido_type',
                'type' => 'select',
                'label' => 'Tipo de contenido',
                'options' => [
                    (object) ['value' => 'viaje', 'text' => 'Viaje'],
                    (object) ['value' => 'vehiculo', 'text' => 'Vehiculo'],
                    (object) ['value' => 'hospedaje', 'text' => 'Hospedaje'],
                ],
            ],
            (object) [
                'id' => 'contenido_id',
                'name' => 'contenido_id',
                'type' => 'select',
                'label' => 'Contenido',
                'options' => [],
            ],
        ];
        $camposEditar = [
            (object) [
                'id' => 'EditNumero_paquete',
                'name' => 'numero_paquete',
                'type' => 'text',
                'label' => 'Codigo de Paquete',
            ],
            (object) [
                'id' => 'contenido_type',
                'name' => 'contenido_type',
                'type' => 'select',
                'label' => 'Tipo de contenido',
                'options' => [
                    (object) ['value' => 'viaje', 'text' => 'Viaje'],
                    (object) ['value' => 'vehiculo', 'text' => 'Vehiculo'],
                    (object) ['value' => 'hospedaje', 'text' => 'Hospedaje'],
                ],
            ],
            (object) [
                'id' => 'contenido_id',
                'name' => 'contenido_id',
                'type' => 'select',
                'label' => 'Contenido',
                'options' => [],
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
    <x-layouts.administracion.sidebar paquetesContenidos="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Contenido de Paquetes">

        <!-- Page Header -->
        <x-layouts.administracion.page-header titulo="Gestion de Contenido de Paquetes"
            contenido="Administra y gestiona el contenido de los paquetes" botonIcono="fas fa-plus"
            botonNombre="Nuevo Contenido" />

        <!-- Search Bar -->
        <x-layouts.administracion.search-bar :inputs="$camposBuscar" />

        <!-- Users Table -->
        @php
            $tHead = ['Paquete', 'Contenido'];
        @endphp
        @include('administracion.partials.tabla', [
            'tHead' => $tHead,
            'nombre' => 'paquetesContenidos',
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
    <script>
        // Datos de ejemplo - reemplaza con tus datos reales de Laravel
        const tablas = {
            viaje: @json($viajes),
            hospedaje: @json($hospedajes),
            vehiculo: @json($vehiculos)
        };

        const tablaSelect = document.getElementsByName('contenido_type');
        const valorSelect = document.getElementsByName('contenido_id');
        console.log(valorSelect);

        // Función para cargar los valores según la tabla seleccionada
        function cargarValores(tabla) {
            // Limpiar select de valores
            valorSelect.innerHTML = '';

            // Agregar opción por defecto
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Seleccionar...';
            valorSelect.forEach(item => {
                item.appendChild(defaultOption);
            });

            // Agregar los valores de la tabla seleccionada
            switch (tabla) {
                case 'viaje':
                    tablas[tabla].forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.nombre;
                        valorSelect.forEach(item => {
                            item.appendChild(option);
                        });
                    });
                    break;
                case 'hospedaje':
                    tablas[tabla].forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.nombre;
                        valorSelect.forEach(item => {
                            item.appendChild(option);
                        });
                    });
                    break;
                case 'vehiculo':
                    tablas[tabla].forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.modelo;
                        valorSelect.forEach(item => {
                            item.appendChild(option);
                        });
                    });
                    break;
                default:
                    break;
            }
        }

        // Función para actualizar la información mostrada
        function actualizarInfo() {
            const tablaSeleccionada = null;
            tablaSeleccionada.forEach(item => {
                tablaSeleccionada = item.value;
            });
            const valorSeleccionado = null;
            const textoValor = null;
            valorSelect.forEach(item => {
                valorSeleccionado = item.value;
                textoValor = item.options[item.selectedIndex].text;
            });

        }

        // Event listeners
        tablaSelect.forEach(item => {
            item.addEventListener('change', function() {
                cargarValores(this.value);
            });
        });
        valorSelect.forEach(item => {
            item.addEventListener('change', function() {
                actualizarInfo();
            });
        });

        // Cargar valores iniciales (primera tabla por defecto)

        tablaSelect.forEach(item => {
            cargarValores(item.value);
        });
    </script>
</body>

</html>
