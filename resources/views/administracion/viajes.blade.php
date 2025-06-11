<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestión de Viajes - Frategar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--despegar-blue) 0%, #004499 100%);
            color: white;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: block;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--despegar-orange);
        }

        .menu-item i {
            width: 20px;
            margin-right: 10px;
        }

        .menu-item[type="submit"] {
            background: none;
            border: none;
            border-left: 3px solid transparent;
            box-shadow: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font: inherit;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
        }

        .top-navbar {
            background-color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h4 {
            margin: 0;
            color: #333;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: var(--despegar-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .dashboard-content {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #666;
            margin: 0;
        }

        .btn-admin {
            background-color: var(--despegar-blue);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-admin:hover {
            background-color: #004499;
            color: white;
        }

        .btn-admin.orange {
            background-color: var(--despegar-orange);
        }

        .btn-admin.orange:hover {
            background-color: #cc5200;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--despegar-blue);
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
        }

        .imagen-viaje {
            width: 100px;
            height: 100px;
            object-fit: cover;
            object-position: center;
            border-radius: 5px;
        }

        .imagen-preview {
            width: 200px;
            height: 200px;
            object-fit: cover;
            object-position: center;
            border-radius: 5px;
        }

        .imagen-detalle {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 10px;
        }

        .table {
            margin-top: 20px;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .action-btn.view {
            background-color: var(--despegar-blue);
        }

        .action-btn.edit {
            background-color: #ffc107;
        }

        .action-btn.delete {
            background-color: #dc3545;
        }

        .action-btn:hover {
            opacity: 0.8;
        }

        .filtros-sidebar {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 5px;
            margin: 20px;
        }

        .filtros-sidebar h5 {
            color: white;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .filtros-sidebar .form-label {
            color: white;
            font-weight: 500;
        }

        .filtros-sidebar .form-control,
        .filtros-sidebar .form-select {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .filtros-sidebar .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .filtros-sidebar .form-control:focus,
        .filtros-sidebar .form-select:focus {
            background-color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .filtros-sidebar .btn {
            width: 100%;
            margin-top: 10px;
            background-color: var(--despegar-orange);
            border: none;
        }

        .filtros-sidebar .btn-secondary {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .filtros-sidebar .btn:hover {
            opacity: 0.9;
        }

        /* Estilos para los filtros horizontales */
        .filtros-horizontales {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .filtros-horizontales .row {
            align-items: flex-end;
        }

        .filtros-horizontales .form-label {
            color: #333;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .filtros-horizontales .form-control,
        .filtros-horizontales .form-select {
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filtros-horizontales .btn {
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .filtros-horizontales .btn-primary {
            background-color: var(--despegar-blue);
            border: none;
        }

        .filtros-horizontales .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        /* Estilos para el modal de detalles */
        .detalles-viaje {
            padding: 20px;
        }

        .detalles-viaje .imagen-principal {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .detalles-viaje .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .detalles-viaje .info-item {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .detalles-viaje .info-label {
            font-weight: 600;
            color: #666;
            margin-bottom: 5px;
        }

        .detalles-viaje .info-value {
            color: #333;
            font-size: 1.1em;
        }

        .detalles-viaje .descripcion {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .detalles-viaje .descripcion h5 {
            color: #333;
            margin-bottom: 10px;
        }

        .detalles-viaje .descripcion p {
            color: #666;
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/administracion" class="sidebar-brand">
                <i class="fas fa-plane me-2"></i>
                <span class="brand-text">Frategar Admin</span>
            </a>
        </div>

        <nav class="sidebar-menu">
            <a href="/administracion" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span class="menu-text">Inicio</span>
            </a>
            <a href="/administracion/reservas" class="menu-item">
                <i class="fas fa-calendar-check"></i>
                <span class="menu-text">Reservas</span>
            </a>
            <a href="/administracion/usuarios" class="menu-item">
                <i class="fas fa-users"></i>
                <span class="menu-text">Usuarios</span>
            </a>
            <a href="/administracion/viajes" class="menu-item active">
                <i class="fas fa-plane"></i>
                <span class="menu-text">Viajes</span>
            </a>
            <a href="/administracion/hoteles" class="menu-item">
                <i class="fas fa-bed"></i>
                <span class="menu-text">Hoteles</span>
            </a>
            <a href="/administracion/vehiculos" class="menu-item">
                <i class="fas fa-car"></i>
                <span class="menu-text">Vehículos</span>
            </a>
            <a href="/administracion/paquetes" class="menu-item">
                <i class="fas fa-tags"></i>
                <span class="menu-text">Paquetes</span>
            </a>
            <a href="/administracion/empleados" class="menu-item">
                <i class="fas fa-users"></i>
                <span class="menu-text">Empleados</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="menu-text">Cerrar Sesión</span>
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="admin-header">
                <h4>Gestión de Viajes</h4>
            </div>

            <div class="admin-user">
                <div class="user-avatar">JP</div>
                <div>
                    <div class="fw-bold">Juan Pérez</div>
                    <small class="text-muted">Administrador</small>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="page-title">Gestión de Viajes</h1>
                        <p class="page-subtitle">Administra todos los viajes disponibles</p>
                    </div>
                    <button type="button" class="btn-admin orange" data-bs-toggle="modal" data-bs-target="#viajeModal">
                        <i class="fas fa-plus"></i>
                        Nuevo Viaje
                    </button>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-number">{{ $viajes->count() }}</div>
                    <div class="stat-label">Total Viajes</div>
                </div>
                <div class="stat-card" style="border-left-color: #28a745;">
                    <div class="stat-number">{{ $viajes->where('tipo', 'aereo')->count() }}</div>
                    <div class="stat-label">Viajes Aéreos</div>
                </div>
                <div class="stat-card" style="border-left-color: #ffc107;">
                    <div class="stat-number">{{ $viajes->where('tipo', 'terrestre')->count() }}</div>
                    <div class="stat-label">Viajes Terrestres</div>
                </div>
                <div class="stat-card" style="border-left-color: #dc3545;">
                    <div class="stat-number">{{ $viajes->where('tipo', 'maritimo')->count() }}</div>
                    <div class="stat-label">Viajes Marítimos</div>
                </div>
            </div>

            <!-- Filtros horizontales -->
            <div class="filtros-horizontales">
                <form id="filtroForm">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="searchText" class="form-label">Buscar</label>
                            <input type="text" class="form-control" id="searchText" placeholder="Buscar...">
                        </div>
                        <div class="col-md-2">
                            <label for="tipoViaje" class="form-label">Tipo de Viaje</label>
                            <select class="form-select" id="tipoViaje">
                                <option value="">Todos</option>
                                <option value="Nacional">Nacional</option>
                                <option value="Internacional">Internacional</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control" id="fechaInicio">
                        </div>
                        <div class="col-md-2">
                            <label for="fechaFin" class="form-label">Fecha Fin</label>
                            <input type="date" class="form-control" id="fechaFin">
                        </div>
                        <div class="col-md-2">
                            <label for="filtroPrecio" class="form-label">Rango de Precio</label>
                            <select class="form-select" id="filtroPrecio">
                                <option value="">Todos</option>
                                <option value="0-1000">$0 - $1,000</option>
                                <option value="1000-5000">$1,000 - $5,000</option>
                                <option value="5000+">$5,000+</option>
                            </select>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-secondary w-100" onclick="limpiarFiltros()">
                                <i class="fas fa-times"></i> Limpiar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabla de viajes -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Tipo</th>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Fecha Salida</th>
                            <th>Fecha Llegada</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viajes as $viaje)
                        <tr>
                            <td>
                                @if($viaje->imagen)
                                    <img src="data:image/jpeg;base64,{{ $viaje->imagen }}" 
                                         alt="Imagen del viaje" 
                                         class="imagen-viaje">
                                @else
                                    <img src="{{ asset('img/no-image.png') }}" 
                                         alt="Sin imagen" 
                                         class="imagen-viaje">
                                @endif
                            </td>
                            <td>{{ ucfirst($viaje->tipo) }}</td>
                            <td>{{ $viaje->origen }}</td>
                            <td>{{ $viaje->destino }}</td>
                            <td>{{ $viaje->fecha_salida->format('d/m/Y H:i') }}</td>
                            <td>{{ $viaje->fecha_llegada->format('d/m/Y H:i') }}</td>
                            <td>${{ number_format($viaje->precio, 2) }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" onclick="verDetalles({{ $viaje->id }})" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" onclick="editarViaje({{ $viaje->id }})" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" onclick="eliminarViaje({{ $viaje->id }})" title="Eliminar">
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
    </div>

    <!-- Modal para crear/editar viaje -->
    <div class="modal fade" id="viajeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viajeModalLabel">Nuevo Viaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="viajeForm" enctype="multipart/form-data">
                        <input type="hidden" id="viaje_id" name="viaje_id">
                        
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Viaje</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="aereo">Aéreo</option>
                                <option value="terrestre">Terrestre</option>
                                <option value="maritimo">Marítimo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="origen" class="form-label">Origen</label>
                            <input type="text" class="form-control" id="origen" name="origen" required>
                        </div>

                        <div class="mb-3">
                            <label for="destino" class="form-label">Destino</label>
                            <input type="text" class="form-control" id="destino" name="destino" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_salida" class="form-label">Fecha de Salida</label>
                            <input type="datetime-local" class="form-control" id="fecha_salida" name="fecha_salida" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_llegada" class="form-label">Fecha de Llegada</label>
                            <input type="datetime-local" class="form-control" id="fecha_llegada" name="fecha_llegada" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            <div id="imagenPreview" class="mt-2"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarViaje()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver detalles -->
    <div class="modal fade" id="detallesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles del Viaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="detalles-viaje">
                        <div id="imagenDetalle" class="text-center">
                            <img src="" alt="Imagen del viaje" class="imagen-principal">
                        </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Tipo de Viaje</div>
                                <div class="info-value" id="detalleTipo"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Origen</div>
                                <div class="info-value" id="detalleOrigen"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Destino</div>
                                <div class="info-value" id="detalleDestino"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Precio</div>
                                <div class="info-value" id="detallePrecio"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Fecha de Salida</div>
                                <div class="info-value" id="detalleFechaSalida"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Fecha de Llegada</div>
                                <div class="info-value" id="detalleFechaLlegada"></div>
                            </div>
                        </div>
                        <div class="descripcion">
                            <h5>Descripción</h5>
                            <p id="detalleDescripcion"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let viajeModal;
    let detallesModal;

    document.addEventListener('DOMContentLoaded', function() {
        viajeModal = new bootstrap.Modal(document.getElementById('viajeModal'));
        detallesModal = new bootstrap.Modal(document.getElementById('detallesModal'));
        
        // Preview de imagen
        document.getElementById('imagen').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagenPreview').innerHTML = `
                        <img src="${e.target.result}" class="imagen-preview">
                    `;
                }
                reader.readAsDataURL(file);
            }
        });
    });

    function aplicarFiltrosEnTiempoReal() {
        const searchText = document.getElementById('searchText').value.toLowerCase();
        const tipoViaje = document.getElementById('tipoViaje').value;
        const fechaInicio = document.getElementById('fechaInicio').value;
        const fechaFin = document.getElementById('fechaFin').value;
        const rangoPrecio = document.getElementById('filtroPrecio').value;

        const filas = document.querySelectorAll('tbody tr');
        let contador = 0;

        filas.forEach(fila => {
            const destino = fila.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const tipo = fila.querySelector('td:nth-child(3)').textContent;
            const fecha = fila.querySelector('td:nth-child(4)').textContent;
            const precioTexto = fila.querySelector('td:nth-child(5)').textContent;
            const precio = parseFloat(precioTexto.replace(/[^0-9.-]+/g, ''));

            const cumpleBusqueda = destino.includes(searchText);
            const cumpleTipo = tipoViaje === '' || tipo === tipoViaje;
            const cumpleFecha = (!fechaInicio || fecha >= fechaInicio) && (!fechaFin || fecha <= fechaFin);
            
            let cumplePrecio = true;
            if (rangoPrecio) {
                switch(rangoPrecio) {
                    case '0-1000':
                        cumplePrecio = precio >= 0 && precio <= 1000;
                        break;
                    case '1000-5000':
                        cumplePrecio = precio > 1000 && precio <= 5000;
                        break;
                    case '5000+':
                        cumplePrecio = precio > 5000;
                        break;
                }
            }

            if (cumpleBusqueda && cumpleTipo && cumpleFecha && cumplePrecio) {
                fila.style.display = '';
                contador++;
            } else {
                fila.style.display = 'none';
            }
        });

        // Actualizar contador
        document.getElementById('totalViajes').textContent = contador;
    }

    // Agregar event listeners cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Event listeners para los campos de filtro
        document.getElementById('searchText').addEventListener('input', aplicarFiltrosEnTiempoReal);
        document.getElementById('tipoViaje').addEventListener('change', aplicarFiltrosEnTiempoReal);
        document.getElementById('fechaInicio').addEventListener('change', aplicarFiltrosEnTiempoReal);
        document.getElementById('fechaFin').addEventListener('change', aplicarFiltrosEnTiempoReal);
        document.getElementById('filtroPrecio').addEventListener('change', aplicarFiltrosEnTiempoReal);

        // Inicializar contador
        aplicarFiltrosEnTiempoReal();
    });

    // Función para limpiar filtros
    function limpiarFiltros() {
        document.getElementById('searchText').value = '';
        document.getElementById('tipoViaje').value = '';
        document.getElementById('fechaInicio').value = '';
        document.getElementById('fechaFin').value = '';
        document.getElementById('filtroPrecio').value = '';
        aplicarFiltrosEnTiempoReal();
    }

    function verDetalles(id) {
        fetch(`/administracion/viajes/${id}`)
            .then(response => response.json())
            .then(viaje => {
                document.getElementById('detalleTipo').textContent = `Viaje ${viaje.tipo.charAt(0).toUpperCase() + viaje.tipo.slice(1)}`;
                document.getElementById('detalleOrigen').textContent = viaje.origen;
                document.getElementById('detalleDestino').textContent = viaje.destino;
                document.getElementById('detalleFechaSalida').textContent = new Date(viaje.fecha_salida).toLocaleString();
                document.getElementById('detalleFechaLlegada').textContent = new Date(viaje.fecha_llegada).toLocaleString();
                document.getElementById('detallePrecio').textContent = `$${parseFloat(viaje.precio).toLocaleString('es-ES', {minimumFractionDigits: 2})}`;
                document.getElementById('detalleDescripcion').textContent = viaje.descripcion || 'Sin descripción';
                
                const imgDetalle = document.querySelector('#imagenDetalle img');
                if (viaje.imagen) {
                    imgDetalle.src = `data:image/jpeg;base64,${viaje.imagen}`;
                } else {
                    imgDetalle.src = "{{ asset('img/no-image.png') }}";
                }
                
                detallesModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar los detalles del viaje');
            });
    }

    function resetForm() {
        document.getElementById('viajeForm').reset();
        document.getElementById('viaje_id').value = '';
        document.getElementById('imagenPreview').innerHTML = '';
        document.getElementById('viajeModalLabel').textContent = 'Nuevo Viaje';
    }

    function guardarViaje() {
        const form = document.getElementById('viajeForm');
        const formData = new FormData(form);
        const viajeId = document.getElementById('viaje_id').value;
        
        const url = viajeId ? `/administracion/viajes/${viajeId}` : '/administracion/viajes';
        const method = viajeId ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors) {
                alert('Por favor, corrija los errores en el formulario.');
                return;
            }
            viajeModal.hide();
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar el viaje');
        });
    }

    function editarViaje(id) {
        fetch(`/administracion/viajes/${id}`)
            .then(response => response.json())
            .then(viaje => {
                document.getElementById('viaje_id').value = viaje.id;
                document.getElementById('tipo').value = viaje.tipo;
                document.getElementById('origen').value = viaje.origen;
                document.getElementById('destino').value = viaje.destino;
                document.getElementById('fecha_salida').value = viaje.fecha_salida;
                document.getElementById('fecha_llegada').value = viaje.fecha_llegada;
                document.getElementById('precio').value = viaje.precio;
                document.getElementById('descripcion').value = viaje.descripcion;
                
                if (viaje.imagen) {
                    document.getElementById('imagenPreview').innerHTML = `
                        <img src="data:image/jpeg;base64,${viaje.imagen}" 
                             class="imagen-preview">
                    `;
                }
                
                document.getElementById('viajeModalLabel').textContent = 'Editar Viaje';
                viajeModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar los datos del viaje');
            });
    }

    function eliminarViaje(id) {
        if (confirm('¿Está seguro de eliminar este viaje?')) {
            fetch(`/administracion/viajes/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar el viaje');
            });
        }
    }

    // Resetear el formulario cuando se cierra el modal
    document.getElementById('viajeModal').addEventListener('hidden.bs.modal', function () {
        resetForm();
    });
    </script>
</body>
</html>
