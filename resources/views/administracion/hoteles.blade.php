<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Hoteles - Frategar Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root {
            --despegar-blue: #0066cc;
            --despegar-orange: #ff6600;
            --despegar-light-blue: #e6f3ff;
            --sidebar-width: 280px;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        .menu-item {
            display: block;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
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
            margin-right: 15px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .top-navbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h4 {
            color: var(--despegar-blue);
            margin: 0;
        }

        .admin-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--despegar-light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--despegar-blue);
            font-weight: bold;
        }

        .dashboard-content {
            padding: 30px;
        }

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
    <!-- Sidebar -->
    <div class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="/administracion" class="sidebar-brand">
                <i class="fas fa-plane me-2"></i>
                <span class="brand-text">Frategar Admin</span>
            </a>
        </div>

        <nav class="sidebar-menu">
            <a href="/administracion" class="menu-item ">
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
            <a href="/administracion/viajes" class="menu-item">
                <i class="fas fa-plane"></i>
                <span class="menu-text">Viajes</span>
            </a>
            <a href="/administracion/hoteles" class="menu-item active">
                <i class="fas fa-bed"></i>
                <span class="menu-text">Hoteles</span>
            </a>
            <a href="/administracion/vehiculos" class="menu-item">
                <i class="fas fa-car"></i>
                <span class="menu-text">Vehiculos</span>
            </a>
            <a href="/administracion/paquetes" class="menu-item">
                <i class="fas fa-tags"></i>
                <span class="menu-text">Paquetes</span>
            </a>
            <a href="/administracion/reportes" class="menu-item">
                <i class="fas fa-chart-bar"></i>
                <span class="menu-text">Reportes</span>
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
                <h4>Gestión de Hoteles</h4>
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
                        <h1 class="page-title">Gestión de Hoteles</h1>
                        <p class="page-subtitle">Administra el inventario de hoteles y habitaciones</p>
                    </div>
                    <a href="#" class="btn-admin orange">
                        <i class="fas fa-plus"></i>
                        Nuevo Hotel
                    </a>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-number">2,847</div>
                    <div class="stat-label">Total Hoteles</div>
                </div>
                <div class="stat-card" style="border-left-color: #28a745;">
                    <div class="stat-number">2,654</div>
                    <div class="stat-label">Hoteles Activos</div>
                </div>
                <div class="stat-card" style="border-left-color: #dc3545;">
                    <div class="stat-number">70</div>
                    <div class="stat-label">Inactivos</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="content-card">
                <div class="search-filters">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label class="form-label">Nombre del Hotel</label>
                            <input type="text" class="form-control" placeholder="Buscar por nombre">
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Ciudad</label>
                            <select class="form-select">
                                <option value="">Todas las ciudades</option>
                                <option value="miami">Miami</option>
                                <option value="paris">París</option>
                                <option value="madrid">Madrid</option>
                                <option value="cancun">Cancún</option>
                                <option value="nyc">Nueva York</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Categoría</label>
                            <select class="form-select">
                                <option value="">Todas las categorías</option>
                                <option value="5">5 Estrellas</option>
                                <option value="4">4 Estrellas</option>
                                <option value="3">3 Estrellas</option>
                                <option value="2">2 Estrellas</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="form-label">Estado</label>
                            <select class="form-select">
                                <option value="">Todos los estados</option>
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                                <option value="maintenance">Mantenimiento</option>
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

            <!-- Hotels Table -->
            <div class="content-card">
                <div class="card-header">
                    <h5 class="card-title">Lista de Hoteles</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn-admin">
                            <i class="fas fa-download"></i>
                            Imprimir PDF
                        </a>
                        <a href="{{ route('administracion.hoteles') }}" class="btn-admin warning">
                            <i class="fas fa-sync"></i>
                            Sincronizar
                        </a>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hotel</th>
                                <th>Ubicación</th>
                                <th>Descripción</th>
                                <th>Estrellas</th>
                                <th>Habitaciones</th>
                                <th>Precio Por Noche</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                       <tbody>
    @foreach($hoteles as $hotel)
    <tr>
        <td>
            <div class="hotel-info">
                <div class="hotel-image">
                    <i class="fas fa-building"></i>
                </div>
                <div class="hotel-details">
                    <h6>{{ $hotel->nombre }}</h6>
                    <small>ID:{{ str_pad($hotel->id, 3, '0', STR_PAD_LEFT) }}</small>
                </div>
            </div>
        </td>
        <td>
            <div><strong>{{ $hotel->ubicacion }}</strong></div>
            <small class="text-muted">{{ $hotel->pais }}</small>
        </td>
         <td>
            <div><strong>{{ $hotel->descripcion }}</strong></div>
        </td>
        <td>
            <div class="rating-stars">
                @for($i = 0; $i < $hotel->estrellas; $i++)
                    <i class="fas fa-star"></i>
                @endfor
                @for($i = $hotel->estrellas; $i < 5; $i++)
                    <i class="far fa-star"></i>
                @endfor
            </div>
            <small class="text-muted">{{ $hotel->estrellas }} Estrellas</small>
        </td>
        <td>
            <div><strong>{{ $hotel->habitaciones }}</strong> habitaciones</div>
        </td>
        <td>
            <div class="price-info">
                <div class="price-amount">${{ $hotel->precio_por_noche }}</div>
                <small class="text-muted">por noche</small>
            </div>
        </td>
        <td>
            @if($hotel->disponibilidad == '1')
                <span class="status-badge status-active">Activo</span>
            @elseif($hotel->disponibilidad == '0')
                <span class="status-badge status-inactive">Inactivo</span>
            @endif
        </td>
        <td>
            <div class="action-buttons">
                <button class="action-btn view" title="Ver detalles">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="action-btn edit" title="Editar" data-bs-toggle="modal" data-bs-target="#modalEditarHotel">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn delete" title="Desactivar">
                    <i class="fas fa-ban"></i>
                </button>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
                    </table>
                </div>

                <!-- Pagination -->
              <!--  <nav>
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
                </nav> -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modal Editar Hotel -->
<div class="modal fade" id="modalEditarHotel" tabindex="-1" aria-labelledby="modalEditarHotelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEditarHotel">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarHotelLabel">Editar Hotel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
         @foreach($hoteles as $hotel1)
        <div class="modal-body">
          <input type="hidden" id="hotel_id" name="id">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $hotel1->nombre }}" required>
          </div>
          <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ $hotel1->ubicacion }}" required>
          </div>
           <div class="mb-3">
            <label for="ubicacion" class="form-label">Descripcion</label>
            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ $hotel1->descripcion }}" required>
          </div>
          <div class="mb-3">
            <label for="estrellas" class="form-label">Estrellas</label>
            <input type="number" class="form-control" id="estrellas" name="estrellas" min="1" max="5"  value="{{ $hotel1->estrellas }}"required>
          </div>
          <div class="mb-3">
            <label for="habitaciones" class="form-label">Habitaciones</label>
            <input type="number" class="form-control" id="habitaciones" name="habitaciones" value="{{ $hotel1->habitaciones }}" required>
          </div>
          <div class="mb-3">
            <label for="precio_por_noche" class="form-label">Precio por Noche</label>
            <input type="number" class="form-control" id="precio_por_noche" name="precio_por_noche"  value="{{ $hotel1->precio_por_noche }}"required>
          </div>
          <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <select class="form-select" id="disponibilidad" name="disponibilidad" required>      
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        @endforeach
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
// Activar modal y cargar datos al hacer click en "Editar"
document.querySelectorAll('.action-btn.edit').forEach(btn => {
    btn.addEventListener('click', function() {
        const row = btn.closest('tr');
        const hotel = {
            id: row.querySelector('small').textContent.replace('ID:', '').trim(),
            nombre: row.querySelector('h6').textContent,
            ubicacion: row.querySelector('td:nth-child(2) div strong').textContent,
            descripcion: row.querySelector('td:nth-child(3) div strong').textContent,
            pais: row.querySelector('td:nth-child(2) small').textContent,
            estrellas: row.querySelectorAll('td:nth-child(3) .fas.fa-star').length,
            habitaciones: row.querySelector('td:nth-child(4) strong').textContent,
            tipos_habitacion: row.querySelector('td:nth-child(4) small').textContent.match(/\d+/)[0],
            precio_por_noche: row.querySelector('td:nth-child(5) .price-amount').textContent.replace('$',''),
            disponibilidad: row.querySelector('td:nth-child(6) .status-badge').classList.contains('status-active') ? '1' : '0'
        };
        document.getElementById('hotel_id').value = hotel.id;
        document.getElementById('nombre').value = hotel.nombre;
        document.getElementById('ubicacion').value = hotel.ubicacion;
        document.getElementById('descripcion').value = hotel.descripcion;
        document.getElementById('estrellas').value = hotel.estrellas;
        document.getElementById('habitaciones').value = hotel.habitaciones;
        document.getElementById('precio_por_noche').value = hotel.precio_por_noche;
        document.getElementById('disponibilidad').value = hotel.disponibilidad;
        new bootstrap.Modal(document.getElementById('modalEditarHotel')).show();
    });
});

// Enviar formulario por fetch
document.getElementById('formEditarHotel').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('hotel_id').value;
    const data = Object.fromEntries(new FormData(this));
    fetch(`/administracion/hoteles/actualizar/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(res => res.ok ? location.reload() : alert('Error al guardar'))
    .catch(() => alert('Error al guardar'));
});
</script>
</body>

</html>
