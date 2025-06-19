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
                <a href="{{ route('administracion.hospedaje') }}" class="btn-admin warning">
                        <i class="fas fa-sync"></i>
                        Sincronizar
                    </a>
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
                </div>
            </div>
<br>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Hospedaje</th>
                            <th>Estrellas</th>
                            <th>Ubicación</th>
                            <th>Categoría</th>
                            <th>Servicios</th>
                            <th>Politicas</th>
                            <th>Descripcion</th>
                            <th>Contacto</th>
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
                                            <small>ID: {{ $hospedaje->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-stars">
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
                                        <a href="{{ route('administracion.hospedaje.habitaciones', $hospedaje->id) }}" class="action-btn view" title="Ver habitaciones">
                                            <i class="fas fa-bed"></i>
                                        </a>
                                        
                                        <button type="button" class="action-btn view" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#verModal"
                                            data-nombre="{{ $hospedaje->nombre }}"
                                            data-estrellas="{{ $hospedaje->estrellas }}"
                                            data-ubicacion="{{ $hospedaje->ubicacion }}"
                                            data-categoria="{{ $hospedaje->categoria }}"
                                            data-servicios="{{ is_array($hospedaje->servicios) ? implode(', ', $hospedaje->servicios) : $hospedaje->servicios }}"
                                            data-politicas="{{ is_array($hospedaje->politicas) }}"
                                            data-descripcion="{{ $hospedaje->descripcion }}"
                                            data-contacto="Tel: {{ $hospedaje->telefono }}, Email: {{ $hospedaje->email }}"
                                            data-horario="{{ $hospedaje->check_in_24h == 1 ? '24 horas' : $hospedaje->check_in . ' - ' . $hospedaje->check_out }}"
                                            data-disponibilidad="{{ $hospedaje->disponibilidad }}"
                                            title="Ver detalles">
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
            <!---    </table>
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
        </div>--->
    </x-layouts.administracion.main>

    @vite('resources/js/sidebar.js')

</script>
