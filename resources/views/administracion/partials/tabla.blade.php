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
        <h5 class="card-title">Lista de Usuarios</h5>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @include('administracion.partials.users-table')
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="pagination-info">
            @if ($users->total() > 0)
                Mostrando {{ $users->firstItem() }} - {{ $users->lastItem() }} de {{ $users->total() }}
                usuarios
            @else
                No hay usuarios para mostrar
            @endif
        </div>
        <div class="pagination-container">
            @include('administracion.partials.pagination')
        </div>
    </div>
</div>
