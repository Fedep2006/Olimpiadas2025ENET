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
    <x-layouts.administracion.sidebar empresas="active" />

    <!-- Main Content -->
    <x-layouts.administracion.main nameHeader="Gestión de Empresas">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Gestión de Empresas</h1>
                    <p class="page-subtitle">Administra el inventario de hoteles y habitaciones</p>
                </div>
                <a href="{{ route('administracion.empresas') }}" class="btn-admin warning">
                        <i class="fas fa-sync"></i>
                        Sincronizar
                    </a>
                <a href="#" class="btn-admin orange" data-bs-toggle="modal" data-bs-target="#AñadirModal">
                    <i class="fas fa-plus"></i>
                    Nueva Empresa
                </a>
            </div>
        </div>

        <!-- Hotels Table -->
        <div class="content-card">
            <div class="card-header">
                <h5 class="card-title">Lista de Empresas</h5>
                <div class="d-flex gap-2">
                </div>
            </div>
<br>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $empresa)
                            <tr>
                                <td>{{ $empresa->id }}</td>
                                <td>{{ $empresa->nombre }}</td>
                                <td>{{ $empresa->tipo }}</td>
                <td class="action-buttons">
                    <a>
                    <button type="button" class="action-btn edit" data-bs-toggle="modal" data-bs-target="#EditarModal-{{ $empresa->id }}">
                    <i class="fas fa-edit"></i>
                    </button>
                    </a>
                    <a>
                      <button type="button" class="action-btn delete" data-bs-toggle="modal" data-bs-target="#BorrarModal-{{ $empresa->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                    </a>
                </td>
            </tr>
            <!-- Editar Modal -->
            <div class="modal fade" id="EditarModal-{{ $empresa->id }}" tabindex="-1" aria-labelledby="EditarModalLabel-{{ $empresa->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="EditarModalLabel-{{ $empresa->id }}">Editar Empresa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route("administracion.empresas.editar")}}" method="POST">
                    @csrf
                    @method('POST')
                      <div class="mb-3">
                        <input type="hidden" name="id" value="{{ $empresa->id }}">
                        <label for="nombreEmpresa-{{ $empresa->id }}" class="form-label">Nombre de la Empresa</label>
                        <input type="text" class="form-control" id="nombreEmpresa-{{ $empresa->id }}" name="nombreEmpresa" value="{{ $empresa->nombre }}" placeholder="Ingrese el nombre de la empresa">
                      </div>
                      <div class="mb-3">
                        <label for="tipoEmpresa-{{ $empresa->id }}" class="form-label">Tipo de Empresa</label>
                        <select class="form-select" id="tipoEmpresa-{{ $empresa->id }}" name="tipoEmpresa">
                          <option value="" disabled {{ $empresa->tipo == '' ? 'selected' : '' }}>Seleccione un tipo</option>
                          <option value="hospedajes" {{ $empresa->tipo == 'hospedajes' ? 'selected' : '' }}>Hospedajes</option>
                          <option value="viajes" {{ $empresa->tipo == 'viajes' ? 'selected' : '' }}>Viajes</option>
                          <option value="paquetes" {{ $empresa->tipo == 'paquetes' ? 'selected' : '' }}>Paquetes</option>
                        </select>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Borrar Modal -->
            <div class="modal fade" id="BorrarModal-{{ $empresa->id }}" tabindex="-1" aria-labelledby="BorrarModalLabel-{{ $empresa->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="BorrarModalLabel-{{ $empresa->id }}">Eliminar Empresa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ¿Está seguro que desea eliminar la empresa "{{ $empresa->nombre }}"?
                  </div>
                  <div class="modal-footer">
                    <form action="{{ route('administracion.empresas.borrar', ['id' => $empresa->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="id" value="{{ $empresa->id }}">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
    </tbody>
</table>
<!-- añadir Modal -->

<div class="modal fade" id="AñadirModal" tabindex="-1" aria-labelledby="AñadirModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AñadirModalLabel">Agregar Empresa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route("administracion.empresas.añadir") }}" method="POST">
        @csrf
        @method('POST')
          <div class="mb-3">
            <label for="nombreEmpresa" class="form-label">Nombre de la Empresa</label>
            <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" placeholder="Ingrese el nombre de la empresa">
          </div>
          <div class="mb-3">
            <label for="tipoEmpresa" class="form-label">Tipo de Empresa</label>
            <select class="form-select" id="tipoEmpresa" name="tipoEmpresa">
              <option value="" selected disabled>Seleccione un tipo</option>
              <option value="hotel">Hotel</option>
              <option value="viajes">Viajes</option>
              <option value="paquetes">Paquetes</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Añadir</button>
        </form>
      </div>
    </div>
  </div>
</div>
    </x-layouts.administracion.main>

    @vite('resources/js/sidebar.js')

</script>
