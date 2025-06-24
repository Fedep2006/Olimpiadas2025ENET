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

    .camino-text {
        color: #6c757d;
        font-size: 14px;
        line-height: 0.95;
    }

    tr {
        text-align: center;
    }
</style>
@php
    $id1 = 0;
@endphp
@if ($registros->isEmpty())
    <tr>
        <td colspan="4" class="text-center">No se encontraron contenidos</td>
    </tr>
@else
    @foreach ($registros as $registro)
        <tr>
            <td>
                <div class="flex flex-col text-center justify-between !self-center align-middle h-full w-full ">
                    <h6>{{ ucfirst($registro->paquete->nombre) }}</h6>
                    <small class="pb-2 font-bold">Codigo: {{ Str::upper($registro->numero_paquete) }}</small>
                </div>
            </td>
            <td>
                <div class="flex flex-col text-center justify-between !self-center align-middle h-full w-full ">
                    <h6>{{ $registro->duracion }} dias</h6>
                </div>
            </td>
            <td>
                <div class="flex flex-col text-center justify-between !self-center h-full w-full text-[14px]">
                    <span>{{ $registro->ubicacion }}</span>
                </div>
            </td>
            <td>
                <div class="flex flex-col text-center justify-between !self-center h-full w-full text-[14px]">
                    <span>{{ $registro->precio_total }}</span>
                </div>
            </td>
            <td>
                <div class="flex flex-col text-center justify-between h-full w-full ">
                    <span>Minimo {{ $registro->cupo_minimo }} personas</span>
                    <span>Maximo {{ $registro->cupo_maximo }} personas</span>
                </div>
            </td>
            <td>
                <span class="badge bg-{{ $registro->hecho_por_usuario ? 'danger' : 'success' }}">
                    {{ $registro->hecho_por_usuario ? 'Hecho por Usuario' : 'Hecho por Empleado' }}
                </span>
            </td>
            <td>
                @php
                    $detalles = [
                        (object) [
                            'titulo' => '',
                            'contenido' => $registro->descripcion,
                        ],
                    ];
                @endphp
                <x-layouts.administracion.modals.mostrar-registro id={{ $id1 }} titulo="Descripcion"
                    :detalles="$detalles" />
            </td>
            <td>
                <span class="badge bg-{{ $registro->activo ? 'success' : 'danger' }}">
                    {{ $registro->activo ? 'Activo' : 'Inactivo' }}
                </span>
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
        @php
            $id1++;
        @endphp
    @endforeach
@endif
