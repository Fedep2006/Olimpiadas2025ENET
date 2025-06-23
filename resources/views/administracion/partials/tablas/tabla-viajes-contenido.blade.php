<style>
    tr{
        text-align: center;
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
        line-height: 0.7;
    }
</style>
@php
    
@endphp
@if ($registros->isEmpty())
    <tr>
        <td colspan="4" class="text-center">No se encontraron viajes</td>
    </tr>
@else
    @php
        $id = 0;
    @endphp
    @foreach ($registros as $registro)
        <tr>
            <td>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col text-center ids gap-1">
                        <h6>{{ ucfirst($registro->tipo) }}</h6>
                        <small>#{{ mb_strtoupper($registro->numero_viaje) }}</small>
                    </div>
                </div>
            </td>
            <td>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col text-center ids gap-1">
                        <h6>{{ $registro->nombre }}</h6>
                    </div>
                </div>
            </td>
            <td>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col text-center ids gap-1">
                        <h6>{{ $registro->origen }}</h6>
                        <small class="camino-text">a</small>
                        <h6>{{ $registro->destino }}</h6>
                    </div>
                </div>
            </td>
            <td>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col text-center ids gap-1">
                        <h6>{{ $registro->pais }}</h6>
                        <small class="camino-text">a</small>
                        <h6>{{ $registro->provincia }}</h6>
                    </div>
                </div>
            </td>
            <td >
                <div class="flex justify-center">
                    <div class="flex flex-col text-center justify-between h-full w-fit ">
                        <span class=" pb-1 mb-1 w-full">
                            Salida: {{ $registro->fecha_salida->format('d/m/Y H:i') }}
                        </span>
                        <span class="pt-1 w-full border-t border-gray-300 ">
                            Llegada: {{ $registro->fecha_llegada->format('d/m/Y H:i') }}
                        </span>
                    </div>
                </div>
            </td>
            <td>{{ $registro->empresa->nombre }}</td>
            <td>
                {{ $registro->asientos_disponibles }}
                /
                {{ $registro->capacidad_total }}
            </td>
            <td>${{ number_format($registro->precio_base, 2) }}</td>
            <td>
                <span class="badge bg-{{ $registro->activo ? 'success' : 'danger' }}">
                    {{ $registro->activo ? 'Activo' : 'Inactivo' }}
                </span>
            </td>
            <td>
                @php
                    $detalles = [
                        (object)[
                            'titulo' => '',
                            'contenido' => $registro->descripcion,
                        ]
                    ];
                @endphp
                <x-layouts.administracion.modals.mostrar-registro id={{$id}} titulo="Descripcion" :detalles="$detalles"/>
            </td>
            <td>
                <div class="action-buttons flex justify-center">
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
            $id++
        @endphp
    @endforeach
@endif