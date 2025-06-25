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
                'id' => 'editPaqueteNumeroPaquete',
                'name' => 'numero_paquete',
                'type' => 'text',
                'label' => 'Codigo de Paquete',
            ],
            (object) [
                'id' => 'editSomething',
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
                'id' => 'editSomething',
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
                'label' => 'Buscar Contenido',
                'type' => 'select',
                'name' => 'search_contenido',
                'id' => 'searchContenido',
                'placeholder' => 'Nombre del contenido',
                'value' => 'search_contenido',
                'options' => [
                    (object) ['value' => 'viaje', 'text' => 'Viaje'],
                    (object) ['value' => 'vehiculo', 'text' => 'Vehiculo'],
                    (object) ['value' => 'hospedaje', 'text' => 'Hospedaje'],
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
        const tablas = {
            viaje: @json($viajes),
            hospedaje: @json($hospedajes),
            vehiculo: @json($vehiculos)
        };

        const tablaSelects = document.getElementsByName('contenido_type');
        const valorSelects = document.getElementsByName('contenido_id');

        // Función para cargar los valores según la tabla seleccionada
        function cargarValores(tabla, targetSelect) {
            // Limpiar select de valores
            targetSelect.innerHTML = '';

            // Agregar opción por defecto
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Seleccionar...';
            targetSelect.appendChild(defaultOption);

            // Agregar los valores de la tabla seleccionada
            if (tablas[tabla]) {
                tablas[tabla].forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;

                    // Usar la propiedad correcta según el tipo
                    switch (tabla) {
                        case 'vehiculo':
                            option.textContent = item.modelo;
                            break;
                        default:
                            option.textContent = item.nombre;
                            break;
                    }

                    targetSelect.appendChild(option);
                });
            }
        }

        // Función para actualizar la información mostrada
        function actualizarInfo(tablaSelect, valorSelect) {
            const tablaSeleccionada = tablaSelect.value;
            const valorSeleccionado = valorSelect.value;
            const textoValor = valorSelect.options[valorSelect.selectedIndex].text;

            // Aquí puedes agregar la lógica que necesites con estos valores
            console.log('Tabla:', tablaSeleccionada, 'Valor:', valorSeleccionado, 'Texto:', textoValor);
        }

        // Event listeners - asociar cada select de tabla con su correspondiente select de valor
        for (let i = 0; i < tablaSelects.length; i++) {
            const tablaSelect = tablaSelects[i];
            const valorSelect = valorSelects[i]; // Asumiendo que hay la misma cantidad de ambos

            if (tablaSelect && valorSelect) {
                // Listener para cambio de tabla
                tablaSelect.addEventListener('change', function() {
                    cargarValores(this.value, valorSelect);
                });

                // Listener para cambio de valor
                valorSelect.addEventListener('change', function() {
                    actualizarInfo(tablaSelect, valorSelect);
                });

                // Cargar valores iniciales si ya hay una tabla seleccionada
                // Solo si el select NO tiene la clase 'no-initial' o data-attribute
                if (tablaSelect.value && !tablaSelect.classList.contains('no-initial')) {
                    cargarValores(tablaSelect.value, valorSelect);
                }
            }
        }
    </script>
</body>

</html>
