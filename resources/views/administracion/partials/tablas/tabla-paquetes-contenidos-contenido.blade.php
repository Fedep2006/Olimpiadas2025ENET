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
@if ($registros->isEmpty())
    <tr>
        <td colspan="4" class="text-center">No se encontraron contenidos</td>
    </tr>
@else
    @foreach ($registros as $registro)
        <tr>
            <td>
                <div class="flex flex-col text-center justify-between !self-center align-middle h-full w-full ">
                    <h6>{{ $registro->paquete->nombre }}</h6>
                    <small class="pb-2 font-bold">Codigo: {{ Str::upper($registro->paquete->numero_paquete) }}</small>
                </div>
            </td>
            <td>
                <div class="flex flex-col text-center justify-between !self-center align-middle h-full w-full">

                    @php
                        $tipoMap = [
                            'App\Models\Vehiculo' => ['nombre' => 'Vehiculo', 'campo' => 'patente'],
                            'App\Models\Viaje' => ['nombre' => 'Viaje', 'campo' => 'numero_viaje'],
                            'App\Models\Hospedaje' => ['nombre' => 'Hospedaje', 'campo' => 'nombre'],
                        ];

                        $tipo = $tipoMap[$registro->contenido_type] ?? null;
                    @endphp

                    @if ($tipo)
                        <h6>{{ $tipo['nombre'] }}</h6>
                        <small class="pb-2 font-bold">
                            Codigo: {{ Str::upper($registro->contenido->{$tipo['campo']}) ?? 'N/A' }}
                        </small>
                    @else
                        <h6>Tipo desconocido</h6>
                        <small class="pb-2 font-bold">Codigo: N/A</small>
                    @endif

                </div>
            </td>
            <td>
                <div class="action-buttons justify-center">
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
