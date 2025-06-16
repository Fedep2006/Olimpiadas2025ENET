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
                                <input type="text" class="form-control" id="tipo" name="tipo" required>
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
                            <label for="servicios" class="form-label">Servicios</label>
                            <input type="text" class="form-control" id="servicios" name="servicios" placeholder="Separados por comas">
                        </div>
                        <div class="mb-3">
                            <label for="camas" class="form-label">Camas</label>
                            <input type="text" class="form-control" id="camas" name="camas" placeholder="Separadas por comas">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="politicas" class="form-label">Políticas</label>
                            <input type="text" class="form-control" id="politicas" name="politicas" placeholder="Separadas por comas">
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
            fetch(`/api/habitaciones/${id}`)
                .then(response => response.json())
                .then(data => {
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
                                <p><strong>Servicios:</strong> ${Array.isArray(data.servicios) ? data.servicios.join(', ') : data.servicios || 'No especificados'}</p>
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
                                <p>${Array.isArray(data.politicas) ? data.politicas.join(', ') : data.politicas || 'No especificadas'}</p>
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
                    console.error('Error:', error);
                    alert('Error al cargar los detalles de la habitación');
                });
        }

        // Función para editar una habitación
        function editarHabitacion(id) {
            fetch(`/api/habitaciones/${id}`)
                .then(response => response.json())
                .then(data => {
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
                                <input type="text" class="form-control" id="tipo" name="tipo" value="${data.tipo}" required>
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
                            <label for="servicios" class="form-label">Servicios</label>
                            <input type="text" class="form-control" id="servicios" name="servicios" value="${Array.isArray(data.servicios) ? data.servicios.join(', ') : data.servicios || ''}" placeholder="Separados por comas">
                        </div>
                        <div class="mb-3">
                            <label for="camas" class="form-label">Camas</label>
                            <input type="text" class="form-control" id="camas" name="camas" value="${Array.isArray(data.camas) ? data.camas.join(', ') : data.camas || ''}" placeholder="Separadas por comas">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3">${data.descripcion || ''}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="politicas" class="form-label">Políticas</label>
                            <input type="text" class="form-control" id="politicas" name="politicas" value="${Array.isArray(data.politicas) ? data.politicas.join(', ') : data.politicas || ''}" placeholder="Separadas por comas">
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="2">${data.observaciones || ''}</textarea>
                        </div>
                    `;
                    
                    new bootstrap.Modal(modal).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar los datos de la habitación');
                });
        }

        // Función para cambiar el estado de una habitación
        function cambiarEstadoHabitacion(id) {
            if (confirm('¿Estás seguro de que deseas cambiar el estado de esta habitación?')) {
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
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || 'Error al cambiar el estado de la habitación');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cambiar el estado de la habitación');
                });
            }
        }
    </script>
</body>

</html> 