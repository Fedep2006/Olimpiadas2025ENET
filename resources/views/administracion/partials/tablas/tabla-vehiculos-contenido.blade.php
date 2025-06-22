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
        .ids h6 {
        margin: 0;
        font-weight: normal;
    }

    small {
        color: #6c757d;
        font-size: 12px;
        line-height: 1;
    }
    .camino-text{
        color: #6c757d;
        font-size: 14px;
        line-height: 0.95;
    }
</style>
@php
    
@endphp
@if ($registros->isEmpty())
    <tr>
        <td colspan="4" class="text-center">No se encontraron vehiculos</td>
    </tr>
@else
    @foreach ($registros as $registro)
        <tr>
            <td>
                <div class="flex flex-col text-center justify-between h-full w-fit ">
                    <h6>{{ ucfirst($registro->modelo) }}</h6>
                    <small class="pb-2 font-bold">{{ ucfirst($registro->marca) }}</small>
                    <small class="pb-1">{{ ucfirst($registro->tipo) }}</small>
                </div>
            </td>
            <td>{{ $registro->patente }}</td>
            <td>{{ $registro->antiguedad }}</td>
            <td>{{ $registro->precio_por_dia }}</td>
            <td>{{ $registro->ubicacion }}</td>
            <td>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col text-center ids gap-1">
                        <h6>{{ ucfirst($registro->pais) }}</h6>
                        <small class="camino-text">
                            {{ $registro->ciudad }} 
                        </small>
                    </div>
                </div>
            </td>
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
