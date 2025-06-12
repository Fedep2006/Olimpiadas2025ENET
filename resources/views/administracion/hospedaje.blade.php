<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>Gestión de Hospedaje - Frategar Admin</title>
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

        .btn-admin.success {
            background-color: #28a745;
        }

        .btn-admin.warning {
            background-color: #ffc107;
            color: #212529;
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

        .status-maintenance {
            background-color: #fff3cd;
            color: #856404;
        }

        .search-filters {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .filter-row {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .form-label {
            font-weight: 500;
            color: var(--despegar-blue);
            margin-bottom: 5px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 12px;
        }

        .table-container {
            overflow-x: auto;
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

        .table tbody tr:hover {
            background-color: #f8f9fa;
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

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--despegar-blue);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--despegar-blue);
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .hotel-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hotel-image {
            width: 60px;
            height: 45px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--despegar-light-blue), #cce7ff);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
            font-size: 1.2rem;
        }

        .hotel-details h6 {
            margin: 0;
            font-weight: bold;
        }

        .hotel-details small {
            color: #6c757d;
        }

        .rating-stars {
            color: #ffc107;
            margin-right: 5px;
        }

        .price-info {
            text-align: right;
        }

        .price-amount {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--despegar-orange);
        }

        .occupancy-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .occupancy-bar {
            width: 100px;
            height: 6px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .occupancy-fill {
            height: 100%;
            border-radius: 3px;
        }

        .occupancy-high {
            background-color: #dc3545;
        }

        .occupancy-medium {
            background-color: #ffc107;
        }

        .occupancy-low {
            background-color: #28a745;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-layouts.administracion.sidebar hospedajes="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Hospedajes">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestión de Hospedaje</h1>
                    <p class="page-subtitle">Administra el inventario de hoteles y habitaciones</p>
                </div>
                <a href="#" class="btn-admin orange" data-bs-toggle="modal" data-bs-target="#agregarModal">
                    <i class="fas fa-plus"></i>
                    Nuevo Hotel
                </a>
            </div>
        </div>

        <!-- Hotels Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Lista de Hospedajes</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('administracion.hospedaje') }}" class="btn-admin warning">
                        <i class="fas fa-sync"></i>
                        Sincronizar
                    </a>
                </div>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Hospedaje</th> <!-- Nombre del hospedaje -->
                            <th>Estrellas</th> <!-- Nombre del hospedaje -->
                            <th>Ubicación</th> <!-- Ubicación del hospedaje -->
                            <th>Categoría</th> <!-- Tipo del hospedaje -->
                            <th>Servicios</th>
                            <th>Politicas</th>
                            <th>Descripcion</th> <!-- Habitaciones del hospedaje -->
                            <th>Contacto</th> <!-- Habitaciones del hospedaje -->
                            <th>Horario</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hospedajes as $hospedaje)
                            <tr>
                                <td>
                                    <div class="hotel-info">
                                        <div class="hotel-image">
                                            <img src="{{ is_array($hospedaje->imagenes) ? $hospedaje->imagenes[0] : $hospedaje->imagenes }}" alt="Imagen del hospedaje" height="45" width="60">
                                        </div>
                                        <div class="hotel-details">
                                            <h6>{{ $hospedaje->nombre }}</h6>
                                            <small>ID:</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-stars">
                                        <i class="fas fa-star"></i>
                                        @for ($i = 0; $i < $hospedaje->estrellas; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i = $hospedaje->estrellas; $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                        <small class="text-muted">{{ $hospedaje->clasificacion }}</small>
                                    </div>
                                    <small class="text-muted"> Estrellas</small>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $hospedaje->ubicacion }}</small>
                                    <small class="text-muted">{{ $hospedaje->pais }}</small>
                                    <small class="text-muted">{{ $hospedaje->ciudad }}</small>
                                    <small class="text-muted">{{ $hospedaje->codigo_postal }}</small>
                                </td>
                                <td>
                                    <div><strong>{{ $hospedaje->tipo }}</strong></div>
                                </td>
                                <td>
                                    <small class="text-muted">{{ is_array($hospedaje->servicios) ? implode(', ', $hospedaje->servicios) : $hospedaje->servicios }}</small>
                                   
                                </td>
                                <td>
                                <small class="text-muted">{{ is_array($hospedaje->politicas) ? implode(', ', $hospedaje->politicas) : $hospedaje->politicas }}</small>
                                </td>
                                <td>
                                    <div><strong>{{ $hospedaje->descripcion }}</strong></div>
                                </td>
                                <td>
                                    <div><strong>{{ $hospedaje->telefono }}</strong></div>
                                    <small class="text-muted">{{ $hospedaje->email }}</small>
                                    <small class="text-muted">{{ $hospedaje->sitio_web }}</small>
                                </td>
                               <!-- <td>
                                    <div class="price-info">
                                        <div class="price-amount">${{ $hospedaje->precio_por_noche }}</div>
                                        <small class="text-muted">por noche</small>
                                    </div>
                                </td>-->
                                <td>
                                    @if ($hospedaje->check_in_24h == 1) 
                                        <div><strong>24 horas</strong></div>
                                    @else
                                        <div><small class="text-muted">{{ $hospedaje->check_in }}</small></div>
                                        <div><small class="text-muted">{{ $hospedaje->check_out }}</small></div>
                                    @endif
                                </td>
                                <td>
                                    @if ($hospedaje->disponibilidad == 1)
                                        <span class="status-badge status-active">Activo</span>
                                    @else
                                        <span class="status-badge status-inactive">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar" data-bs-toggle="modal" data-bs-target="#editarModal" data-hospedaje-id="{{ $hospedaje->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Desactivar" data-bs-toggle="modal" data-bs-target="#eliminarModal" data-hospedaje-id="{{ $hospedaje->id }}">
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

    @vite('resources/js/sidebar.js')
    <!-- Modal -->
<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Hospedaje</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('administracion.hospedaje.Agregar') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre comercial del establecimiento</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de establecimiento de hospedaje</label>
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="hotel">Hotel</option>
                    <option value="hostal">Hostal</option>
                    <option value="apartamento">Apartamento</option>
                    <option value="resort">Resort</option>
                    <option value="bed_and_breakfast">Bed & Breakfast</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Dirección física del establecimiento</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
            </div>
            <div class="mb-3">
                <label for="pais" class="form-label">País donde se encuentra el establecimiento</label>
                <input type="text" class="form-control" id="pais" name="pais" required>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad donde se encuentra el establecimiento</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" required>
            </div>
            <div class="mb-3">
                <label for="codigo_postal" class="form-label">Código postal de la ubicación</label>
                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
            </div>
            <div class="mb-3">
                <label for="estrellas" class="form-label">Clasificación del establecimiento (1 a 5 estrellas)</label>
                <select class="form-select" id="estrellas" name="estrellas" required>
                    <option value="1">1 Estrella</option>
                    <option value="2">2 Estrellas</option>
                    <option value="3">3 Estrellas</option>
                    <option value="4">4 Estrellas</option>
                    <option value="5">5 Estrellas</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="calificacion" class="form-label">Calificación promedio (0.00 a 5.00)</label>
                <input type="number" class="form-control" id="calificacion" name="calificacion" step="0.01" min="0" max="5" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción detallada del establecimiento y sus instalaciones</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Servicios ofrecidos</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="wifi" id="servicio_wifi" {{ is_array($hospedaje->servicios) && in_array('wifi', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_wifi">WiFi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="piscina" id="servicio_piscina" {{ is_array($hospedaje->servicios) && in_array('piscina', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_piscina">Piscina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="restaurante" id="servicio_restaurante" {{ is_array($hospedaje->servicios) && in_array('restaurante', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_restaurante">Restaurante</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="gimnasio" id="servicio_gimnasio" {{ is_array($hospedaje->servicios) && in_array('gimnasio', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_gimnasio">Gimnasio</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="spa" id="servicio_spa" {{ is_array($hospedaje->servicios) && in_array('spa', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_spa">Spa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="estacionamiento" id="servicio_estacionamiento" {{ is_array($hospedaje->servicios) && in_array('estacionamiento', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_estacionamiento">Estacionamiento</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Políticas del establecimiento</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="politicas[]" value="mascotas" id="politica_mascotas" {{ is_array($hospedaje->politicas) && in_array('mascotas', $hospedaje->politicas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="politica_mascotas">Permite mascotas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="politicas[]" value="fumar" id="politica_fumar" {{ is_array($hospedaje->politicas) && in_array('fumar', $hospedaje->politicas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="politica_fumar">Permite fumar</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="politicas[]" value="ninios" id="politica_ninios" {{ is_array($hospedaje->politicas) && in_array('ninios', $hospedaje->politicas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="politica_ninios">Apto para niños</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="politicas[]" value="cancelacion" id="politica_cancelacion" {{ is_array($hospedaje->politicas) && in_array('cancelacion', $hospedaje->politicas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="politica_cancelacion">Política de cancelación flexible</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="imagenes" class="form-label">URL de la imagen del establecimiento</label>
                <input type="text" class="form-control" id="imagenes" name="imagenes" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Número de teléfono de contacto</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico de contacto</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="sitio_web" class="form-label">URL del sitio web oficial</label>
                <input type="text" class="form-control" id="sitio_web" name="sitio_web">
            </div>
            <div class="mb-3">
                <label for="check_in" class="form-label">Hora estándar de check-in</label>
                <input type="time" class="form-control" id="check_in" name="check_in" required>
            </div>
            <div class="mb-3">
                <label for="check_out" class="form-label">Hora estándar de check-out</label>
                <input type="time" class="form-control" id="check_out" name="check_out" required>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="check_in_24h" name="check_in_24h" value="1">
                    <label class="form-check-label" for="check_in_24h">
                        Permite check-in las 24 horas
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Notas adicionales sobre el establecimiento</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
            </div>
            <div class="mb-3">
            
                    <select class="form-select" id="disponibilidad" name="disponibilidad" required>
                    <option value="1">Disponible</option>
                    <option value="0">No Disponible</option>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Hospedaje</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Hospedaje</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('administracion.hospedaje.Editar') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $hospedaje->id }}">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre comercial del establecimiento</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $hospedaje->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de establecimiento de hospedaje</label>
                <select class="form-select" id="tipo" name="tipo" value="{{ $hospedaje->tipo }}" required>
                    <option value="hotel">Hotel</option>
                    <option value="hostal">Hostal</option>
                    <option value="apartamento">Apartamento</option>
                    <option value="resort">Resort</option>
                    <option value="bed_and_breakfast">Bed & Breakfast</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Dirección física del establecimiento</label>
                <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ $hospedaje->ubicacion }}" required>
            </div>
            <div class="mb-3">
                <label for="pais" class="form-label">País donde se encuentra el establecimiento</label>
                <input type="text" class="form-control" id="pais" name="pais" value="{{ $hospedaje->pais }}" required>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad donde se encuentra el establecimiento</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $hospedaje->ciudad }}" required>
            </div>
            <div class="mb-3">
                <label for="codigo_postal" class="form-label">Código postal de la ubicación</label>
                <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{ $hospedaje->codigo_postal }}" required>
            </div>
            <div class="mb-3">
                <label for="estrellas" class="form-label">Clasificación del establecimiento (1 a 5 estrellas)</label>
                <select class="form-select" id="estrellas" name="estrellas" required>
                    <option value="1" {{ $hospedaje->estrellas == 1 ? 'selected' : '' }}>1 Estrella</option>
                    <option value="2" {{ $hospedaje->estrellas == 2 ? 'selected' : '' }}>2 Estrellas</option>
                    <option value="3" {{ $hospedaje->estrellas == 3 ? 'selected' : '' }}>3 Estrellas</option>
                    <option value="4" {{ $hospedaje->estrellas == 4 ? 'selected' : '' }}>4 Estrellas</option>
                    <option value="5" {{ $hospedaje->estrellas == 5 ? 'selected' : '' }}>5 Estrellas</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="calificacion" class="form-label">Calificación promedio (0.00 a 5.00)</label>
                <input type="number" class="form-control" id="calificacion" name="calificacion" step="0.01" min="0" max="5" value="{{ $hospedaje->calificacion }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción detallada del establecimiento y sus instalaciones</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ $hospedaje->descripcion }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Servicios ofrecidos</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="wifi" id="servicio_wifi" {{ is_array($hospedaje->servicios) && in_array('wifi', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_wifi">WiFi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="piscina" id="servicio_piscina" {{ is_array($hospedaje->servicios) && in_array('piscina', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_piscina">Piscina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="restaurante" id="servicio_restaurante" {{ is_array($hospedaje->servicios) && in_array('restaurante', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_restaurante">Restaurante</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="gimnasio" id="servicio_gimnasio" {{ is_array($hospedaje->servicios) && in_array('gimnasio', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_gimnasio">Gimnasio</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="spa" id="servicio_spa" {{ is_array($hospedaje->servicios) && in_array('spa', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_spa">Spa</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="servicios[]" value="estacionamiento" id="servicio_estacionamiento" {{ is_array($hospedaje->servicios) && in_array('estacionamiento', $hospedaje->servicios) ? 'checked' : '' }}>
                            <label class="form-check-label" for="servicio_estacionamiento">Estacionamiento</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Políticas del establecimiento</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="politicas[]" value="mascotas" id="politica_mascotas" {{ is_array($hospedaje->politicas) && in_array('mascotas', $hospedaje->politicas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="politica_mascotas">Permite mascotas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="politicas[]" value="fumar" id="politica_fumar" {{ is_array($hospedaje->politicas) && in_array('fumar', $hospedaje->politicas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="politica_fumar">Permite fumar</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="politicas[]" value="ninios" id="politica_ninios" {{ is_array($hospedaje->politicas) && in_array('ninios', $hospedaje->politicas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="politica_ninios">Apto para niños</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="politicas[]" value="cancelacion" id="politica_cancelacion" {{ is_array($hospedaje->politicas) && in_array('cancelacion', $hospedaje->politicas) ? 'checked' : '' }}>
                            <label class="form-check-label" for="politica_cancelacion">Política de cancelación flexible</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="imagenes" class="form-label">URL de la imagen del establecimiento</label>
                <input type="text" class="form-control" id="imagenes" name="imagenes" value="{{ $hospedaje->imagenes }}" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Número de teléfono de contacto</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ $hospedaje->telefono }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico de contacto</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $hospedaje->email }}" required>
            </div>
            <div class="mb-3">
                <label for="sitio_web" class="form-label">URL del sitio web oficial</label>
                <input type="text" class="form-control" id="sitio_web" name="sitio_web" value="{{ $hospedaje->sitio_web }}">
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="check_in_24h" name="check_in_24h" value="1">
                    <label class="form-check-label" for="check_in_24h">
                        Permite check-in las 24 horas
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="check_in" class="form-label">Hora estándar de check-in</label>
                <input type="time" class="form-control" id="check_in" name="check_in" value="{{ $hospedaje->check_in }}" required>
            </div>
            <div class="mb-3">
                <label for="check_out" class="form-label">Hora estándar de check-out</label>
                <input type="time" class="form-control" id="check_out" name="check_out" value="{{ $hospedaje->check_out }}" required>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Notas adicionales sobre el establecimiento</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{ $hospedaje->observaciones }}</textarea>
            </div>
            <div class="mb-3">
            
                    <select class="form-select" id="disponibilidad" name="disponibilidad" required>
                    <option value="1" {{ $hospedaje->disponibilidad == 1 ? 'selected' : '' }}>Disponible</option>
                    <option value="0" {{ $hospedaje->disponibilidad == 0 ? 'selected' : '' }}>No Disponible</option>
                </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Hospedaje</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">  
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Hospedaje</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de querer eliminar este hospedaje?</p>
                <form action="{{ route('administracion.hospedaje.Borrar', $hospedaje->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})
</script>

</html>
