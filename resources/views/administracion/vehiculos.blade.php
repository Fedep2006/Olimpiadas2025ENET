<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Autos - Frategar Admin</title>
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

        .status-available {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rented {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-maintenance {
            background-color: #f8d7da;
            color: #721c24;
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

        .car-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .car-image {
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

        .car-details h6 {
            margin: 0;
            font-weight: bold;
        }

        .car-details small {
            color: #6c757d;
        }

        .price-info {
            text-align: right;
        }

        .price-amount {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--despegar-orange);
        }

        .category-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .category-economy {
            background-color: #e7f3ff;
            color: #0066cc;
        }

        .category-compact {
            background-color: #fff3e0;
            color: #ff6600;
        }

        .category-suv {
            background-color: #f3e5f5;
            color: #9c27b0;
        }

        .category-luxury {
            background-color: #fff8e1;
            color: #ff9800;
        }

        .features-list {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .feature-item {
            background: #f8f9fa;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-layouts.administracion.sidebar vehiculos="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Vehiculos">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestión de Autos</h1>
                    <p class="page-subtitle">Administra la flota de vehículos de alquiler</p>
                </div>
                <a href="{{ route('administracion.vehiculos') }}" class="btn-admin warning">
                        <i class="fas fa-sync"></i>
                        Sincronizar
                    </a>
                <a href="" class="btn-admin orange" data-bs-toggle="modal" data-bs-target="#AñadirVehiculo">
                    <i class="fas fa-plus"></i>
                    Nuevo Vehículo
                </a>
            </div>
        </div>

        <!-- Filters -->
  <!--      <div class="content-card">
            <div class="search-filters">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="form-label">Modelo del Vehículo</label>
                        <input type="text" class="form-control" placeholder="Buscar por marca o modelo">
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Categoría</label>
                        <select class="form-select">
                            <option value="">Todas las categorías</option>
                            <option value="economy">Económico</option>
                            <option value="compact">Compacto</option>
                            <option value="suv">SUV</option>
                            <option value="luxury">Lujo</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Ubicación</label>
                        <select class="form-select">
                            <option value="">Todas las ubicaciones</option>
                            <option value="miami">Miami</option>
                            <option value="paris">París</option>
                            <option value="madrid">Madrid</option>
                            <option value="cancun">Cancún</option>
                            <option value="nyc">Nueva York</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Estado</label>
                        <select class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="available">Disponible</option>
                            <option value="rented">Alquilado</option>
                            <option value="maintenance">Mantenimiento</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Año</label>
                        <select class="form-select">
                            <option value="">Todos los años</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button class="btn-admin">
                                <i class="fas fa-search"></i>
                                Buscar
                            </button>
                            <button class="btn-admin" style="background-color: #6c757d;">
                                <i class="fas fa-times"></i>
                                Limpiar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    -->
        <!-- Cars Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Lista de Vehículos</h5>
                <div class="d-flex gap-2">
                </div>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                        <th class="text-center"></th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Datos del Vehículo</th>
                        <th class="text-center">Ubicación</th>
                        <th class="text-center">Precio por Día</th>
                        <th class="text-center">Características</th>
                        <th class="text-center">Observaciones</th>
                        <th class="text-center">Disponible</th>
                        <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($vehiculo as $vehiculos)
                    <td class="text-center"><img src="{{ $vehiculos->imagenes[0] }}" alt="Imagen del vehículo" class="img-fluid" style="width: 100px; height: 100px;"></td>
                    <td class="text-center">{{ $vehiculos->id }}</td>
                    <td class="text-center">{{ $vehiculos->tipo }}</td>

                    <td class="text-center"> 
                    <small class="text-muted">Marca:{{ $vehiculos->marca }}</small>
                    <br>
                    <small class="text-muted">Modelo:{{ $vehiculos->modelo }}</small>
                    <br>
                    <small class="text-muted">Año:{{ $vehiculos->antiguedad }}</small>
                    <br>
                    <small class="text-muted">Patente:{{ $vehiculos->patente }}</small>
                    <br>
                    <small class="text-muted">Color:{{ $vehiculos->color }}</small>
                    <br>
                    <small class="text-muted">Capacidad:{{ $vehiculos->capacidad_pasajeros }}</small>
                    <br>
                    </td>
                    <td class="text-center">{{ $vehiculos->ubicacion }}</td>
                    <td class="text-center">{{ $vehiculos->precio_por_dia }}</td>
                    <td class="text-center">{{ is_array($vehiculos->caracteristicas) ? implode(', ', $vehiculos->caracteristicas) : $vehiculos->caracteristicas }}</td>
                    <td class="text-center">{{ $vehiculos->observaciones }}</td>
                    <td class="text-center">{{ $vehiculos->disponible }}</td>
                    <td class="text-center">

                    
                                    <div class="action-buttons">
                                        <button class="action-btn view" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" title="Editar" data-bs-toggle="modal" data-bs-target="#EditarVehiculo">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" title="Desactivar" data-bs-toggle="modal" data-bs-target="#EliminarVehiculo" >
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                
                    </td>
                
                    </tbody>
                    @endforeach
                </table>
            </div>

            <!-- Pagination -->
            <nav class="d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Anterior</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </x-layouts.administracion.main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @vite('resources/js/sidebar.js')

    <!-- Modal para editar vehículos -->
    <div class="modal fade" id="EditarVehiculo" tabindex="-1" aria-labelledby="EditarVehiculoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="EditarVehiculoLabel">Editar Vehículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('administracion.vehiculos.editar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $vehiculos->id }}">
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de vehículo</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="auto" {{ $vehiculos->tipo == 'auto' ? 'selected' : '' }}>Automovil</option>
                                <option value="camioneta" {{ $vehiculos->tipo == 'camioneta' ? 'selected' : '' }}>Camioneta</option>
                                <option value="moto" {{ $vehiculos->tipo == 'moto' ? 'selected' : '' }}>Moto</option>
                                <option value="bicicleta" {{ $vehiculos->tipo == 'bicicleta' ? 'selected' : '' }}>Bicicleta</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" value="{{ $vehiculos->marca }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="modelo" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $vehiculos->modelo }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="antiguedad" class="form-label">Año de fabricación</label>
                            <input type="number" class="form-control" id="antiguedad" name="antiguedad" value="{{ $vehiculos->antiguedad }}" min="1900" max="{{ date('Y') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="patente" class="form-label">Patente / Matrícula</label>
                            <input type="text" class="form-control" id="patente" name="patente" value="{{ $vehiculos->patente }}" maxlength="10" minlength="10" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" value="{{ $vehiculos->color }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacidad_pasajeros" class="form-label">Capacidad de pasajeros</label>
                            <input type="number" class="form-control" id="capacidad_pasajeros" name="capacidad_pasajeros" value="{{ $vehiculos->capacidad_pasajeros }}" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación actual</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ $vehiculos->ubicacion }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio_por_dia" class="form-label">Precio por día</label>
                            <input type="number" class="form-control" id="precio_por_dia" name="precio_por_dia" value="{{ $vehiculos->precio_por_dia }}" max="10,2" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="disponible" class="form-label">¿Disponible para alquiler?</label>
                            <select class="form-select" id="disponible" name="disponible" required>
                                <option value="1" {{ $vehiculos->disponible == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ $vehiculos->disponible == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imagenes" class="form-label">Imágenes del vehículo (URLs, separadas por coma)</label>
                            <input type="text" class="form-control" id="imagenes" name="imagenes[]" value="{{ is_array($vehiculos->imagenes) ? implode(', ', $vehiculos->imagenes) : $vehiculos->imagenes }}" placeholder="https://ejemplo.com/auto1.jpg, https://ejemplo.com/auto2.jpg">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Características del vehículo</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="GPS" id="caracteristica_gps" {{ in_array('GPS', (array)$vehiculos->caracteristicas) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="caracteristica_gps">GPS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="Bluetooth" id="caracteristica_bluetooth" {{ in_array('Bluetooth', (array)$vehiculos->caracteristicas) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="caracteristica_bluetooth">Bluetooth</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="Aire Acondicionado" id="caracteristica_aire" {{ in_array('Aire Acondicionado', (array)$vehiculos->caracteristicas) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="caracteristica_aire">Aire Acondicionado</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="Camara de Reversa" id="caracteristica_camara" {{ in_array('Camara de Reversa', (array)$vehiculos->caracteristicas) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="caracteristica_camara">Camara de Reversa</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" value="{{ $vehiculos->observaciones }}"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar Vehículo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar vehículos -->
    <div class="modal fade" id="EliminarVehiculo" tabindex="-1" aria-labelledby="EliminarVehiculoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="EliminarVehiculoLabel">Desactivar Vehículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas desactivar este vehículo? Esta acción no se puede deshacer.</p>
                    <form action="{{ route('administracion.vehiculos.borrar', ['id' => $vehiculos->id]) }}" method="post">
    @csrf
    @method('DELETE')   
    <!-- El input hidden de id ya no es necesario -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Desactivar Vehículo</button>
    </div>
</form>

    <!-- Modal para agregar vehículos -->
    <div class="modal fade" id="AñadirVehiculo" tabindex="-1" aria-labelledby="AñadirVehiculoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="AñadirVehiculoLabel">Agregar Vehículo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('administracion.vehiculos.añadir') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de vehículo</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="auto" {{ $vehiculos->tipo == 'auto' ? 'selected' : '' }}>Automovil</option>
                                <option value="camioneta" {{ $vehiculos->tipo == 'camioneta' ? 'selected' : '' }}>Camioneta</option>
                                <option value="moto" {{ $vehiculos->tipo == 'moto' ? 'selected' : '' }}>Moto</option>
                                <option value="bicicleta" {{ $vehiculos->tipo == 'bicicleta' ? 'selected' : '' }}>Bicicleta</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                        </div>
                        <div class="mb-3">
                            <label for="modelo" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" required>
                        </div>
                        <div class="mb-3">
                            <label for="antiguedad" class="form-label">Año de fabricación</label>
                            <input type="number" class="form-control" id="antiguedad" name="antiguedad" min="1900" max="{{ date('Y') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="patente" class="form-label">Patente / Matrícula</label>
                            <input type="text" class="form-control" id="patente" name="patente" maxlength="10" minlength="10" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacidad_pasajeros" class="form-label">Capacidad de pasajeros</label>
                            <input type="number" class="form-control" id="capacidad_pasajeros" name="capacidad_pasajeros" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación actual</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio_por_dia" class="form-label">Precio por día</label>
                            <input type="number" class="form-control" id="precio_por_dia" name="precio_por_dia" min="0" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="disponible" class="form-label">¿Disponible para alquiler?</label>
                            <select class="form-select" id="disponible" name="disponible" required>
                                <option value="1" {{ $vehiculos->disponible == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ $vehiculos->disponible == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="imagenes" class="form-label">Imágenes del vehículo (URLs, separadas por coma)</label>
                            <input type="text" class="form-control" id="imagenes" name="imagenes[]" placeholder="https://ejemplo.com/auto1.jpg, https://ejemplo.com/auto2.jpg">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Características del vehículo</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="GPS" id="caracteristicas">
                                        <label class="form-check-label" for="caracteristicas">GPS</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="Bluetooth" id="caracteristicas">
                                        <label class="form-check-label" for="caracteristicas">Bluetooth</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="Aire Acondicionado" id="caracteristicas">
                                        <label class="form-check-label" for="caracteristicas">Aire Acondicionado</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="caracteristicas[]" value="Camara de Reversa" id="caracteristicas">
                                        <label class="form-check-label" for="caracteristicas">Camara de Reversa</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Vehículo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
