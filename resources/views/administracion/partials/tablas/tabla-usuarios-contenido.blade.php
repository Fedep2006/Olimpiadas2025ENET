<style>
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

    .action-btn.edit {
        background-color: #ffc107;
        color: #212529;
    }

    .action-btn.delete {
        background-color: #dc3545;
        color: white;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-profile-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--despegar-light-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--despegar-blue);
        font-weight: bold;
        font-size: 1.1rem;
    }

    .user-info h6 {
        margin: 0;
        font-weight: bold;
    }

    .user-info small {
        color: #6c757d;
    }
</style>
@php
    
@endphp
@if ($registros->isEmpty())
    <tr>
        <td colspan="4" class="text-center">No se encontraron usuarios</td>
    </tr>
@else
    @foreach ($registros as $registro)
        <tr>
            <td>
                <div class="user-profile">
                    <div class="user-profile-avatar">
                        {{ substr($registro->name, 0, 2) }}
                    </div>
                    <div class="user-info">
                        <h6>{{ $registro->name }}</h6>
                        <small>ID: {{ $registro->id }}</small>
                    </div>
                </div>
            </td>
            <td>{{ $registro->email }}</td>
            <td>{{ $registro->created_at->format('d/m/Y H:i') }}</td>
            <td>
                <div class="action-buttons">
                    <button class="action-btn edit" data-registro="{{ $registro }}" title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="action-btn delete" data-registro-id="{{ $registro->id }}" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
@endif
