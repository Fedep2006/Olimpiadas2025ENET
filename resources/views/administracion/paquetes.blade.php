<!DOCTYPE html>
<html lang="es">

<head>
    @include('administracion.partials.head')
    <title>Gestión de Promociones - Frategar Admin</title>

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

        .status-expired {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-scheduled {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-paused {
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

        .action-btn.pause {
            background-color: #6c757d;
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

        .promo-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .promo-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--despegar-orange), #ff8533);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .promo-details h6 {
            margin: 0;
            font-weight: bold;
        }

        .promo-details small {
            color: #6c757d;
        }

        .discount-badge {
            background: linear-gradient(135deg, var(--despegar-orange), #ff8533);
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1rem;
        }

        .usage-stats {
            text-align: center;
        }

        .usage-number {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--despegar-blue);
        }

        .usage-bar {
            width: 100px;
            height: 6px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
            margin: 5px auto;
        }

        .usage-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--despegar-blue), var(--despegar-orange));
            border-radius: 3px;
        }

        .type-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .type-percentage {
            background-color: #e7f3ff;
            color: #0066cc;
        }

        .type-fixed {
            background-color: #fff3e0;
            color: #ff6600;
        }

        .type-bogo {
            background-color: #f3e5f5;
            color: #9c27b0;
        }

        .type-free {
            background-color: #e8f5e8;
            color: #2e7d32;
        }
    </style>
</head>

<body>


    <!-- Sidebar -->
    <x-layouts.administracion.sidebar paquetes="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestion de Paquetes">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestión de Paquetes</h1>
                    <p class="page-subtitle">Crea y administra ofertas especiales y descuentos</p>
                </div>
                  <a href="{{ route('administracion.paquetes') }}" class="btn-admin warning">
                        <i class="fas fa-sync"></i>
                        Sincronizar
                    </a>
                <a href="#" class="btn-admin orange" data-bs-toggle="modal" data-bs-target="#agregarPaqueteModal">
                    <i class="fas fa-plus"></i>
                    Nueva Promoción
                </a>
            </div>
        </div>

        <!-- Filters
        <div class="content-card">
            <div class="search-filters">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="form-label">Nombre de la PAquete</label>
                        <input type="text" class="form-control" placeholder="Buscar por nombre o código">
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Tipo</label>
                        <select class="form-select">
                            <option value="">Todos los tipos</option>
                            <option value="percentage">Descuento %</option>
                            <option value="fixed">Descuento fijo</option>
                            <option value="bogo">2x1</option>
                            <option value="free">Gratis</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Categoría</label>
                        <select class="form-select">
                            <option value="">Todas las categorías</option>
                            <option value="flights">Vuelos</option>
                            <option value="hotels">Hoteles</option>
                            <option value="cars">Autos</option>
                            <option value="packages">Paquetes</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Estado</label>
                        <select class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="active">Activa</option>
                            <option value="scheduled">Programada</option>
                            <option value="paused">Pausada</option>
                            <option value="expired">Expirada</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="form-label">Fecha de Vencimiento</label>
                        <input type="date" class="form-control">
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
        <!-- Promotions Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Lista de Paquetes</h5>
                <div class="d-flex gap-2">
                </div>
            </div>
<br>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio Total</th>
                            <th>Duración</th>
                            <th>Ubicación</th>
                            <th>Cupo Mínimo</th>
                            <th>Cupo Máximo</th>
                            <th>Activo</th>
                            <th>Condiciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paquetes as $paquete)
                        <tr>
                            <td>{{ $paquete->nombre }}</td>
                            <td>{{ $paquete->descripcion }}</td>
                            <td>${{ number_format($paquete->precio_total, 2) }}</td>
                            <td>{{ $paquete->duracion }}</td>
                            <td>{{ $paquete->ubicacion }}</td>
                            <td>{{ $paquete->cupo_minimo }}</td>
                            <td>{{ $paquete->cupo_maximo }}</td>
                            <td>
                                @if($paquete->activo)
                                    <span class="status-badge status-active">Sí</span>
                                @else
                                    <span class="status-badge status-expired">No</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn-admin btn-sm" data-bs-toggle="modal" data-bs-target="#condicionesModal{{ $paquete->id }}">
                                    Ver
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="condicionesModal{{ $paquete->id }}" tabindex="-1" aria-labelledby="condicionesLabel{{ $paquete->id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="condicionesLabel{{ $paquete->id }}">Condiciones del Paquete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                      </div>
                                      <div class="modal-body">
                                        {{ $paquete->condiciones }}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('administracion.paquetes.show', $paquete->id) }}" class="action-btn view" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('administracion.paquetes.edit', $paquete->id) }}" class="action-btn edit" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('administracion.paquetes.destroy', $paquete->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este paquete?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal para ver condiciones del paquete -->
                        @endforeach

<!-- Modal para agregar Paquete -->
<div class="modal fade" id="agregarPaqueteModal" tabindex="-1" aria-labelledby="agregarPaqueteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarPaqueteLabel">Agregar Paquete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('administracion.paquetes.añadir') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Paquete</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="precio_total" class="form-label">Precio Total</label>
                        <input type="number" class="form-control" id="precio_total" name="precio_total" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="duracion" class="form-label">Duración</label>
                        <input type="text" class="form-control" id="duracion" name="duracion" required>
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="cupo_minimo" class="form-label">Cupo Mínimo</label>
                        <input type="number" class="form-control" id="cupo_minimo" name="cupo_minimo" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="cupo_maximo" class="form-label">Cupo Máximo</label>
                        <input type="number" class="form-control" id="cupo_maximo" name="cupo_maximo" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="activo" class="form-label">Activo</label>
                        <select class="form-select" id="activo" name="activo" required>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="condiciones" class="form-label">Condiciones</label>
                        <textarea class="form-control" id="condiciones" name="condiciones" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Paquete</button>
                </div>
            </form>
        </div>
    </div>
</div>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav>
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
</body>

</html>
