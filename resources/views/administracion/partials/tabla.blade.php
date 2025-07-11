<style>
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

    .pagination-container {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 1rem;
    }
</style>
<div class="content-card">
    <div class="card-header">
        <h5 class="card-title">Lista de {{ ucfirst($nombre) }}</h5>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    @foreach ($tHead as $col)
                        <th>{{ $col }}</th>
                    @endforeach
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tBody">
                @switch($nombre)
                    @case('usuarios')
                        @include('administracion.partials.tablas.tabla-usuarios-contenido')
                    @break

                    @case('viajes')
                        @include('administracion.partials.tablas.tabla-viajes-contenido')
                    @break

                    @case('vehiculos')
                        @include('administracion.partials.tablas.tabla-vehiculos-contenido')
                    @break

                    @case('reservas')
                        @include('administracion.partials.tablas.tabla-reservas-contenido')
                    @break

                    @case('paquetes')
                        @include('administracion.partials.tablas.tabla-paquetes-contenido')
                    @break

                    @case('paquetesContenidos')
                        @include('administracion.partials.tablas.tabla-paquetes-contenidos-contenido')
                    @break

                    @case('hospedajes')
                        @include('administracion.partials.tablas.tabla-hospedajes-contenido')
                    @break

                    @case('empresas')
                        @include('administracion.partials.tablas.tabla-empresas-contenido')
                    @break

                    @default
                @endswitch
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="pagination-info">
            @if ($registros->total() > 0)
                Mostrando {{ $registros->firstItem() }} - {{ $registros->lastItem() }} de {{ $registros->total() }}
                {{ $nombre }}
            @else
                No hay {{ $nombre }} para mostrar
            @endif
        </div>
        <div class="pagination-container">
            @include('administracion.partials.pagination')
        </div>
    </div>
</div>
