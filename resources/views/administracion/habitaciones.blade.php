<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Habitaciones - {{ $hospedaje->nombre }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .page-header {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .page-title {
            color: var(--despegar-blue);
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }

        .page-subtitle {
            color: #6c757d;
            margin: 5px 0 0 0;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .card-title {
            color: var(--despegar-blue);
            font-weight: bold;
            margin: 0;
        }

        .btn-admin {
            background-color: var(--despegar-blue);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-admin:hover {
            background-color: #0052a3;
            color: white;
        }

        .btn-admin.orange {
            background-color: var(--despegar-orange);
        }

        .table th {
            background-color: var(--despegar-light-blue);
            color: var(--despegar-blue);
            font-weight: bold;
            border: none;
            padding: 15px 12px;
        }

        .table td {
            padding: 15px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .action-btn.view {
            background-color: #17a2b8;
            color: white;
        }

        .action-btn.edit {
            background-color: #ffc107;
            color: #212529;
        }

        .action-btn.delete {
            background-color: #dc3545;
            color: white;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .form-select, .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-check {
            margin-bottom: 0.5rem;
        }

        .form-check-input {
            border: 2px solid #ced4da;
            border-radius: 4px;
            transition: all 0.15s ease-in-out;
        }

        .form-check-input:checked {
            background-color: var(--despegar-blue);
            border-color: var(--despegar-blue);
        }

        .form-check-input:focus {
            border-color: var(--despegar-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        .form-check-label {
            color: #495057;
            font-weight: 500;
            cursor: pointer;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <x-layouts.administracion.sidebar hospedajes="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Habitaciones - {{ $hospedaje->nombre }}">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Habitaciones - {{ $hospedaje->nombre }}</h1>
                    <p class="page-subtitle">Administra las habitaciones de este establecimiento</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('administracion.hospedaje') }}" class="btn-admin">
                        <i class="fas fa-arrow-left"></i>
                        Volver a Hospedajes
                    </a>
                    <a href="#" class="btn-admin orange" data-bs-toggle="modal" data-bs-target="#agregarModal">
                        <i class="fas fa-plus"></i>
                        Nueva Habitación
                    </a>
                </div>
            </div>
        </div>

        <!-- Habitaciones Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Lista de Habitaciones</h5>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Capacidad</th>
                            <th>Precio/Noche</th>
                            <th>Características</th>
                            <th>Servicios</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hospedaje->habitaciones as $habitacion)
                            <tr>
                                <td>{{ $habitacion->numero }}</td>
                                <td>{{ $habitacion->tipo }}</td>
                                <td>{{ $habitacion->capacidad_personas }} personas</td>
                                <td>${{ number_format($habitacion->precio_por_noche, 2) }}</td>
                                <td>
                                    <small class="text-muted">
                                        {{ is_array($habitacion->caracteristicas) ? implode(', ', $habitacion->caracteristicas) : $habitacion->caracteristicas }}
                                    </small>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ is_array($habitacion->servicios) ? implode(', ', $habitacion->servicios) : $habitacion->servicios }}
                                    </small>
                                </td>
                                <td>
                                    @if ($habitacion->disponible)
                                        <span class="status-badge status-active">Disponible</span>
                                    @else
                                        <span class="status-badge status-inactive">No Disponible</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles" onclick="verHabitacion({{ $habitacion->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar" onclick="editarHabitacion({{ $habitacion->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Cambiar estado" onclick="cambiarEstadoHabitacion({{ $habitacion->id }})">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                        <button class="action-btn delete" title="Eliminar" onclick="confirmarEliminar({{ $habitacion->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-layouts.administracion.main>

    <!-- Modal Agregar Habitación -->
    <div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Nueva Habitación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('administracion.habitaciones.agregar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="hospedaje_id" value="{{ $hospedaje->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="numero" class="form-label">Número de Habitación</label>
                                <input type="text" class="form-control" id="numero" name="numero" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label">Tipo de Habitación</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="individual">Individual</option>
                                    <option value="doble">Doble</option>
                                    <option value="triple">Triple</option>
                                    <option value="cuadruple">Cuádruple</option>
                                    <option value="suite">Suite</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="capacidad_personas" class="form-label">Capacidad de Personas</label>
                                <input type="number" class="form-control" id="capacidad_personas" name="capacidad_personas" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="precio_por_noche" class="form-label">Precio por Noche</label>
                                <input type="number" class="form-control" id="precio_por_noche" name="precio_por_noche" min="0" step="0.01" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="precio_extra_persona" class="form-label">Precio Extra por Persona</label>
                                <input type="number" class="form-control" id="precio_extra_persona" name="precio_extra_persona" min="0" step="0.01">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="metros_cuadrados" class="form-label">Metros Cuadrados</label>
                                <input type="number" class="form-control" id="metros_cuadrados" name="metros_cuadrados" min="1">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="caracteristicas" class="form-label">Características</label>
                            <input type="text" class="form-control" id="caracteristicas" name="caracteristicas" placeholder="Separadas por comas">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Servicios</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="wifi" id="wifi">
                                        <label class="form-check-label" for="wifi">WiFi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="tv" id="tv">
                                        <label class="form-check-label" for="tv">TV</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="aire_acondicionado" id="aire_acondicionado">
                                        <label class="form-check-label" for="aire_acondicionado">Aire Acondicionado</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="calefaccion" id="calefaccion">
                                        <label class="form-check-label" for="calefaccion">Calefacción</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="minibar" id="minibar">
                                        <label class="form-check-label" for="minibar">Minibar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="caja_fuerte" id="caja_fuerte">
                                        <label class="form-check-label" for="caja_fuerte">Caja Fuerte</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="balcon" id="balcon">
                                        <label class="form-check-label" for="balcon">Balcón</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="vista_mar" id="vista_mar">
                                        <label class="form-check-label" for="vista_mar">Vista al Mar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="jacuzzi" id="jacuzzi">
                                        <label class="form-check-label" for="jacuzzi">Jacuzzi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="room_service" id="room_service">
                                        <label class="form-check-label" for="room_service">Room Service</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="limpieza_diaria" id="limpieza_diaria">
                                        <label class="form-check-label" for="limpieza_diaria">Limpieza Diaria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="secador_pelo" id="secador_pelo">
                                        <label class="form-check-label" for="secador_pelo">Secador de Pelo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Camas</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_individual" id="cama_individual">
                                        <label class="form-check-label" for="cama_individual">Cama Individual</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_doble" id="cama_doble">
                                        <label class="form-check-label" for="cama_doble">Cama Doble</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_king" id="cama_king">
                                        <label class="form-check-label" for="cama_king">Cama King</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_queen" id="cama_queen">
                                        <label class="form-check-label" for="cama_queen">Cama Queen</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="sofa_cama" id="sofa_cama">
                                        <label class="form-check-label" for="sofa_cama">Sofá Cama</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_litera" id="cama_litera">
                                        <label class="form-check-label" for="cama_litera">Cama Litera</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_extra" id="cama_extra">
                                        <label class="form-check-label" for="cama_extra">Cama Extra</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cuna" id="cuna">
                                        <label class="form-check-label" for="cuna">Cuna</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Políticas</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="no_fumar" id="no_fumar">
                                        <label class="form-check-label" for="no_fumar">No Fumar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="no_mascotas" id="no_mascotas">
                                        <label class="form-check-label" for="no_mascotas">No Mascotas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="solo_adultos" id="solo_adultos">
                                        <label class="form-check-label" for="solo_adultos">Solo Adultos</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="check_in_24h" id="check_in_24h">
                                        <label class="form-check-label" for="check_in_24h">Check-in 24h</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="cancelacion_gratuita" id="cancelacion_gratuita">
                                        <label class="form-check-label" for="cancelacion_gratuita">Cancelación Gratuita</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="desayuno_incluido" id="desayuno_incluido">
                                        <label class="form-check-label" for="desayuno_incluido">Desayuno Incluido</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="estacionamiento" id="estacionamiento">
                                        <label class="form-check-label" for="estacionamiento">Estacionamiento</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="accesibilidad" id="accesibilidad">
                                        <label class="form-check-label" for="accesibilidad">Accesibilidad</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Habitación -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Habitación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editarForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <!-- Los campos serán llenados dinámicamente con JavaScript -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ver Habitación -->
    <div class="modal fade" id="verModal" tabindex="-1" aria-labelledby="verModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verModalLabel">Detalles de la Habitación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Los detalles serán llenados dinámicamente con JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Eliminación -->
    <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta habitación?</p>
                    <p class="text-muted">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="eliminarForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Información -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Información</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="infoModalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Carga -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-3 mb-0" id="loadingMessage">Procesando...</p>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/sidebar.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Configurar el token CSRF para todas las peticiones AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Función para ver los detalles de una habitación
        function verHabitacion(id) {
            mostrarCarga('Cargando detalles de la habitación...');
            
            fetch(`/administracion/habitaciones/datos/${id}`)
                .then(response => response.json())
                .then(data => {
                    ocultarCarga();
                    const modal = document.getElementById('verModal');
                    const modalBody = modal.querySelector('.modal-body');
                    
                    modalBody.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Número:</strong> ${data.numero}</p>
                                <p><strong>Tipo:</strong> ${data.tipo}</p>
                                <p><strong>Capacidad:</strong> ${data.capacidad_personas} personas</p>
                                <p><strong>Precio por Noche:</strong> $${data.precio_por_noche}</p>
                                <p><strong>Precio Extra por Persona:</strong> $${data.precio_extra_persona || 'No aplica'}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Metros Cuadrados:</strong> ${data.metros_cuadrados || 'No especificado'}</p>
                                <p><strong>Estado:</strong> ${data.disponible ? 'Disponible' : 'No Disponible'}</p>
                                <p><strong>Características:</strong> ${Array.isArray(data.caracteristicas) ? data.caracteristicas.join(', ') : data.caracteristicas || 'No especificadas'}</p>
                                <p><strong>Servicios:</strong> ${convertirServicios(data.servicios)}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <p><strong>Descripción:</strong></p>
                                <p>${data.descripcion || 'No especificada'}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <p><strong>Políticas:</strong></p>
                                <p>${convertirPoliticas(data.politicas)}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <p><strong>Camas:</strong></p>
                                <p>${convertirCamas(data.camas)}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <p><strong>Observaciones:</strong></p>
                                <p>${data.observaciones || 'No especificadas'}</p>
                            </div>
                        </div>
                    `;
                    
                    new bootstrap.Modal(modal).show();
                })
                .catch(error => {
                    ocultarCarga();
                    console.error('Error:', error);
                    mostrarInfo('Error al cargar los detalles de la habitación');
                });
        }

        // Función para editar una habitación
        function editarHabitacion(id) {
            mostrarCarga('Cargando datos de la habitación...');
            
            fetch(`/administracion/habitaciones/datos/${id}`)
                .then(response => response.json())
                .then(data => {
                    ocultarCarga();
                    const modal = document.getElementById('editarModal');
                    const form = document.getElementById('editarForm');
                    const modalBody = modal.querySelector('.modal-body');
                    
                    form.action = `/administracion/habitaciones/${id}/editar`;
                    
                    modalBody.innerHTML = `
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="numero" class="form-label">Número de Habitación</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="${data.numero}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label">Tipo de Habitación</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="individual" ${data.tipo === 'individual' ? 'selected' : ''}>Individual</option>
                                    <option value="doble" ${data.tipo === 'doble' ? 'selected' : ''}>Doble</option>
                                    <option value="triple" ${data.tipo === 'triple' ? 'selected' : ''}>Triple</option>
                                    <option value="cuadruple" ${data.tipo === 'cuadruple' ? 'selected' : ''}>Cuádruple</option>
                                    <option value="suite" ${data.tipo === 'suite' ? 'selected' : ''}>Suite</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="capacidad_personas" class="form-label">Capacidad de Personas</label>
                                <input type="number" class="form-control" id="capacidad_personas" name="capacidad_personas" value="${data.capacidad_personas}" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="precio_por_noche" class="form-label">Precio por Noche</label>
                                <input type="number" class="form-control" id="precio_por_noche" name="precio_por_noche" value="${data.precio_por_noche}" min="0" step="0.01" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="precio_extra_persona" class="form-label">Precio Extra por Persona</label>
                                <input type="number" class="form-control" id="precio_extra_persona" name="precio_extra_persona" value="${data.precio_extra_persona || ''}" min="0" step="0.01">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="metros_cuadrados" class="form-label">Metros Cuadrados</label>
                                <input type="number" class="form-control" id="metros_cuadrados" name="metros_cuadrados" value="${data.metros_cuadrados || ''}" min="1">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="caracteristicas" class="form-label">Características</label>
                            <input type="text" class="form-control" id="caracteristicas" name="caracteristicas" value="${Array.isArray(data.caracteristicas) ? data.caracteristicas.join(', ') : data.caracteristicas || ''}" placeholder="Separadas por comas">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Servicios</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="wifi" id="wifi" ${Array.isArray(data.servicios) && data.servicios.includes('wifi') ? 'checked' : ''}>
                                        <label class="form-check-label" for="wifi">WiFi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="tv" id="tv" ${Array.isArray(data.servicios) && data.servicios.includes('tv') ? 'checked' : ''}>
                                        <label class="form-check-label" for="tv">TV</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="aire_acondicionado" id="aire_acondicionado" ${Array.isArray(data.servicios) && data.servicios.includes('aire_acondicionado') ? 'checked' : ''}>
                                        <label class="form-check-label" for="aire_acondicionado">Aire Acondicionado</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="calefaccion" id="calefaccion" ${Array.isArray(data.servicios) && data.servicios.includes('calefaccion') ? 'checked' : ''}>
                                        <label class="form-check-label" for="calefaccion">Calefacción</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="minibar" id="minibar" ${Array.isArray(data.servicios) && data.servicios.includes('minibar') ? 'checked' : ''}>
                                        <label class="form-check-label" for="minibar">Minibar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="caja_fuerte" id="caja_fuerte" ${Array.isArray(data.servicios) && data.servicios.includes('caja_fuerte') ? 'checked' : ''}>
                                        <label class="form-check-label" for="caja_fuerte">Caja Fuerte</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="balcon" id="balcon" ${Array.isArray(data.servicios) && data.servicios.includes('balcon') ? 'checked' : ''}>
                                        <label class="form-check-label" for="balcon">Balcón</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="vista_mar" id="vista_mar" ${Array.isArray(data.servicios) && data.servicios.includes('vista_mar') ? 'checked' : ''}>
                                        <label class="form-check-label" for="vista_mar">Vista al Mar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="jacuzzi" id="jacuzzi" ${Array.isArray(data.servicios) && data.servicios.includes('jacuzzi') ? 'checked' : ''}>
                                        <label class="form-check-label" for="jacuzzi">Jacuzzi</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="room_service" id="room_service" ${Array.isArray(data.servicios) && data.servicios.includes('room_service') ? 'checked' : ''}>
                                        <label class="form-check-label" for="room_service">Room Service</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="limpieza_diaria" id="limpieza_diaria" ${Array.isArray(data.servicios) && data.servicios.includes('limpieza_diaria') ? 'checked' : ''}>
                                        <label class="form-check-label" for="limpieza_diaria">Limpieza Diaria</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="servicios[]" value="secador_pelo" id="secador_pelo" ${Array.isArray(data.servicios) && data.servicios.includes('secador_pelo') ? 'checked' : ''}>
                                        <label class="form-check-label" for="secador_pelo">Secador de Pelo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Camas</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_individual" id="cama_individual" ${Array.isArray(data.camas) && data.camas.includes('cama_individual') ? 'checked' : ''}>
                                        <label class="form-check-label" for="cama_individual">Cama Individual</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_doble" id="cama_doble" ${Array.isArray(data.camas) && data.camas.includes('cama_doble') ? 'checked' : ''}>
                                        <label class="form-check-label" for="cama_doble">Cama Doble</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_king" id="cama_king" ${Array.isArray(data.camas) && data.camas.includes('cama_king') ? 'checked' : ''}>
                                        <label class="form-check-label" for="cama_king">Cama King</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_queen" id="cama_queen" ${Array.isArray(data.camas) && data.camas.includes('cama_queen') ? 'checked' : ''}>
                                        <label class="form-check-label" for="cama_queen">Cama Queen</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="sofa_cama" id="sofa_cama" ${Array.isArray(data.camas) && data.camas.includes('sofa_cama') ? 'checked' : ''}>
                                        <label class="form-check-label" for="sofa_cama">Sofá Cama</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_litera" id="cama_litera" ${Array.isArray(data.camas) && data.camas.includes('cama_litera') ? 'checked' : ''}>
                                        <label class="form-check-label" for="cama_litera">Cama Litera</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cama_extra" id="cama_extra" ${Array.isArray(data.camas) && data.camas.includes('cama_extra') ? 'checked' : ''}>
                                        <label class="form-check-label" for="cama_extra">Cama Extra</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="camas[]" value="cuna" id="cuna" ${Array.isArray(data.camas) && data.camas.includes('cuna') ? 'checked' : ''}>
                                        <label class="form-check-label" for="cuna">Cuna</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3">${data.descripcion || ''}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Políticas</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="no_fumar" id="no_fumar" ${Array.isArray(data.politicas) && data.politicas.includes('no_fumar') ? 'checked' : ''}>
                                        <label class="form-check-label" for="no_fumar">No Fumar</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="no_mascotas" id="no_mascotas" ${Array.isArray(data.politicas) && data.politicas.includes('no_mascotas') ? 'checked' : ''}>
                                        <label class="form-check-label" for="no_mascotas">No Mascotas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="solo_adultos" id="solo_adultos" ${Array.isArray(data.politicas) && data.politicas.includes('solo_adultos') ? 'checked' : ''}>
                                        <label class="form-check-label" for="solo_adultos">Solo Adultos</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="check_in_24h" id="check_in_24h" ${Array.isArray(data.politicas) && data.politicas.includes('check_in_24h') ? 'checked' : ''}>
                                        <label class="form-check-label" for="check_in_24h">Check-in 24h</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="cancelacion_gratuita" id="cancelacion_gratuita" ${Array.isArray(data.politicas) && data.politicas.includes('cancelacion_gratuita') ? 'checked' : ''}>
                                        <label class="form-check-label" for="cancelacion_gratuita">Cancelación Gratuita</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="desayuno_incluido" id="desayuno_incluido" ${Array.isArray(data.politicas) && data.politicas.includes('desayuno_incluido') ? 'checked' : ''}>
                                        <label class="form-check-label" for="desayuno_incluido">Desayuno Incluido</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="estacionamiento" id="estacionamiento" ${Array.isArray(data.politicas) && data.politicas.includes('estacionamiento') ? 'checked' : ''}>
                                        <label class="form-check-label" for="estacionamiento">Estacionamiento</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="politicas[]" value="accesibilidad" id="accesibilidad" ${Array.isArray(data.politicas) && data.politicas.includes('accesibilidad') ? 'checked' : ''}>
                                        <label class="form-check-label" for="accesibilidad">Accesibilidad</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="2">${data.observaciones || ''}</textarea>
                        </div>
                    `;
                    
                    new bootstrap.Modal(modal).show();
                })
                .catch(error => {
                    ocultarCarga();
                    console.error('Error:', error);
                    mostrarInfo('Error al cargar los datos de la habitación');
                });
        }

        // Función para cambiar el estado de una habitación
        function cambiarEstadoHabitacion(id) {
            mostrarConfirmacion(
                'Cambiar Estado',
                '¿Estás seguro de que deseas cambiar el estado de esta habitación?',
                function() {
                    mostrarCarga('Cambiando estado de la habitación...');
                    
                    fetch(`/administracion/habitaciones/${id}/cambiar-estado`, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        ocultarCarga();
                        if (data.success) {
                            window.location.reload();
                        } else {
                            mostrarInfo(data.message || 'Error al cambiar el estado de la habitación');
                        }
                    })
                    .catch(error => {
                        ocultarCarga();
                        console.error('Error:', error);
                        mostrarInfo('Error al cambiar el estado de la habitación');
                    });
                }
            );
        }

        // Función para confirmar la eliminación de una habitación
        function confirmarEliminar(id) {
            const modal = document.getElementById('eliminarModal');
            const form = document.getElementById('eliminarForm');
            
            form.action = `/administracion/habitaciones/${id}`;
            
            new bootstrap.Modal(modal).show();
        }

        // Función para mostrar modal de información
        function mostrarInfo(mensaje) {
            const modal = document.getElementById('infoModal');
            const messageElement = document.getElementById('infoModalMessage');
            
            messageElement.textContent = mensaje;
            new bootstrap.Modal(modal).show();
        }

        // Función para mostrar modal de confirmación personalizado
        function mostrarConfirmacion(titulo, mensaje, onConfirm) {
            const modal = document.getElementById('eliminarModal');
            const titleElement = modal.querySelector('.modal-title');
            const bodyElement = modal.querySelector('.modal-body p');
            
            titleElement.textContent = titulo;
            bodyElement.textContent = mensaje;
            
            // Remover el formulario existente y agregar botones personalizados
            const footer = modal.querySelector('.modal-footer');
            footer.innerHTML = `
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="confirmarAccion()">Confirmar</button>
            `;
            
            // Guardar la función de confirmación
            window.confirmarAccion = onConfirm;
            
            new bootstrap.Modal(modal).show();
        }

        // Función para mostrar modal de carga
        function mostrarCarga(mensaje = 'Procesando...') {
            const modal = document.getElementById('loadingModal');
            const messageElement = document.getElementById('loadingMessage');
            
            messageElement.textContent = mensaje;
            new bootstrap.Modal(modal).show();
        }

        // Función para ocultar modal de carga
        function ocultarCarga() {
            const modal = document.getElementById('loadingModal');
            const bootstrapModal = bootstrap.Modal.getInstance(modal);
            if (bootstrapModal) {
                bootstrapModal.hide();
            }
        }

        // Función para limpiar el formulario de agregar
        function limpiarFormularioAgregar() {
            const form = document.querySelector('form[action*="habitaciones/agregar"]');
            if (form) {
                form.reset();
            }
        }

        // Agregar evento para limpiar formulario cuando se cierre el modal de agregar
        document.addEventListener('DOMContentLoaded', function() {
            const agregarModal = document.getElementById('agregarModal');
            if (agregarModal) {
                agregarModal.addEventListener('hidden.bs.modal', function() {
                    limpiarFormularioAgregar();
                });
            }
        });

        // Manejador para el formulario de edición
        document.addEventListener('DOMContentLoaded', function() {
            const editarForm = document.getElementById('editarForm');
            if (editarForm) {
                editarForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Validación del lado del cliente
                    const numero = this.querySelector('#numero').value.trim();
                    const tipo = this.querySelector('#tipo').value;
                    const capacidad = this.querySelector('#capacidad_personas').value;
                    const precio = this.querySelector('#precio_por_noche').value;
                    
                    if (!numero) {
                        mostrarInfo('El número de habitación es requerido');
                        return;
                    }
                    
                    if (!tipo) {
                        mostrarInfo('Debe seleccionar un tipo de habitación');
                        return;
                    }
                    
                    if (!capacidad || capacidad < 1) {
                        mostrarInfo('La capacidad debe ser al menos 1 persona');
                        return;
                    }
                    
                    if (!precio || precio < 0) {
                        mostrarInfo('El precio por noche debe ser mayor o igual a 0');
                        return;
                    }
                    
                    mostrarCarga('Guardando cambios...');
                    
                    const formData = new FormData(this);
                    formData.append('_method', 'PUT'); // Agregar método PUT
                    
                    fetch(this.action, {
                        method: 'POST', // Siempre usar POST para formularios
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                        } else {
                            return response.text();
                        }
                    })
                    .then(data => {
                        ocultarCarga();
                        if (data) {
                            // Si hay respuesta de texto, mostrar mensaje
                            mostrarInfo('Habitación actualizada correctamente');
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        ocultarCarga();
                        console.error('Error:', error);
                        mostrarInfo('Error al actualizar la habitación');
                    });
                });
            }

            // Manejador para el formulario de agregar habitación
            const agregarForm = document.querySelector('form[action*="habitaciones/agregar"]');
            if (agregarForm) {
                agregarForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Validación del lado del cliente
                    const numero = this.querySelector('#numero').value.trim();
                    const tipo = this.querySelector('#tipo').value;
                    const capacidad = this.querySelector('#capacidad_personas').value;
                    const precio = this.querySelector('#precio_por_noche').value;
                    
                    if (!numero) {
                        mostrarInfo('El número de habitación es requerido');
                        return;
                    }
                    
                    if (!tipo) {
                        mostrarInfo('Debe seleccionar un tipo de habitación');
                        return;
                    }
                    
                    if (!capacidad || capacidad < 1) {
                        mostrarInfo('La capacidad debe ser al menos 1 persona');
                        return;
                    }
                    
                    if (!precio || precio < 0) {
                        mostrarInfo('El precio por noche debe ser mayor o igual a 0');
                        return;
                    }
                    
                    mostrarCarga('Agregando habitación...');
                    
                    const formData = new FormData(this);
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                        } else {
                            return response.text();
                        }
                    })
                    .then(data => {
                        ocultarCarga();
                        if (data) {
                            mostrarInfo('Habitación agregada correctamente');
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        ocultarCarga();
                        console.error('Error:', error);
                        mostrarInfo('Error al agregar la habitación');
                    });
                });
            }
        });

        // Función para convertir códigos de servicios a nombres legibles
        function convertirServicios(servicios) {
            if (!servicios || !Array.isArray(servicios)) {
                return 'No especificados';
            }
            
            const serviciosMap = {
                'wifi': 'WiFi',
                'tv': 'TV',
                'aire_acondicionado': 'Aire Acondicionado',
                'calefaccion': 'Calefacción',
                'minibar': 'Minibar',
                'caja_fuerte': 'Caja Fuerte',
                'balcon': 'Balcón',
                'vista_mar': 'Vista al Mar',
                'jacuzzi': 'Jacuzzi',
                'room_service': 'Room Service',
                'limpieza_diaria': 'Limpieza Diaria',
                'secador_pelo': 'Secador de Pelo'
            };
            
            return servicios.map(servicio => serviciosMap[servicio] || servicio).join(', ');
        }

        // Función para convertir códigos de camas a nombres legibles
        function convertirCamas(camas) {
            if (!camas || !Array.isArray(camas)) {
                return 'No especificadas';
            }
            
            const camasMap = {
                'cama_individual': 'Cama Individual',
                'cama_doble': 'Cama Doble',
                'cama_king': 'Cama King',
                'cama_queen': 'Cama Queen',
                'sofa_cama': 'Sofá Cama',
                'cama_litera': 'Cama Litera',
                'cama_extra': 'Cama Extra',
                'cuna': 'Cuna'
            };
            
            return camas.map(cama => camasMap[cama] || cama).join(', ');
        }

        // Función para convertir códigos de políticas a nombres legibles
        function convertirPoliticas(politicas) {
            if (!politicas || !Array.isArray(politicas)) {
                return 'No especificadas';
            }
            
            const politicasMap = {
                'no_fumar': 'No Fumar',
                'no_mascotas': 'No Mascotas',
                'solo_adultos': 'Solo Adultos',
                'check_in_24h': 'Check-in 24h',
                'cancelacion_gratuita': 'Cancelación Gratuita',
                'desayuno_incluido': 'Desayuno Incluido',
                'estacionamiento': 'Estacionamiento',
                'accesibilidad': 'Accesibilidad'
            };
            
            return politicas.map(politica => politicasMap[politica] || politica).join(', ');
        }
    </script>
</body>

</html> 