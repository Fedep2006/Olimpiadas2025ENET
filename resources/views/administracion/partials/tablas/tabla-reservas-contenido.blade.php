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

    .ids h6 {
        margin: 0;
        font-weight: normal;
    }

    small {
        color: #6c757d;
        font-size: 12px;
        line-height: 1;
    }

    .camino-text {
        color: #6c757d;
        font-size: 14px;
        line-height: 0.95;
    }

    tr {
        text-align: center;
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
        <td colspan="4" class="text-center">No se encontraron reservas</td>
    </tr>
@else
    @foreach ($registros as $registro)
        <tr>
            <td>
                <div class="user-profile pl-5">
                    <div class="user-profile-avatar">
                        {{ substr($registro->usuario->name, 0, 2) }}
                    </div>
                    <div class="user-info">
                        <h6>{{ $registro->usuario->name }}</h6>
                        <small class="pb-2 font-bold">{{ $registro->usuario->email }}</small>
                    </div>
                </div>
            </td>
            <td>
                <span>Codigo: <small class="pb-2 font-bold">{{ $registro->codigo_reserva }}</small></span>
            </td>
            <td>
                <h6>{{ $registro->paquete->nombre }}</h6>
                <small class="pb-2 font-bold">Codigo: {{ Str::upper($registro->paquete->numero_paquete) }}</small>
            </td>
            <td>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col text-center ids gap-1">
                        <h6>{{ $registro->fecha_inicio->format('d/m/Y H:i') }}</h6>
                        <small class="camino-text">a</small>
                        <h6>{{ $registro->fecha_fin->format('d/m/Y H:i') }}</h6>
                    </div>
                </div>
            </td>
            <td>
                <h6>{{ $registro->precio_total }}</h6>
            </td>
            <td>
                @if ($registro->estado == 'pendiente')
                    <h6 class="badge bg-amber-500 p-3 !text-[1rem] text-dark">Pendiente</h6>
                @elseif($registro->estado == 'cancelada')
                    <span class="badge bg-red-500 p-3 !text-[1rem] ">Cancelado</span>
                @elseif($registro->estado == 'confirmada')
                    <span class="badge bg-success p-3 !text-[1rem]">Confirmada</span>
                @else
                    <span class="badge bg-secondary p-3 !text-[1rem]">Completado</span>
                @endif
            </td>
            <td>
                <div class="action-buttons justify-center">
                    <button class="action-btn edit" data-registro="{{ $registro }}" title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
@endif
