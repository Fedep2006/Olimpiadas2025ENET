
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
        <td colspan="4" class="text-center">No se encontraron hospedajes</td>
    </tr>
@else
    @php
        $id1 = 0;
        $id2 = 100;
        $id3 = 200;
        $id4 = 300;
    @endphp
    @foreach ($registros as $registro)
        <tr>
            <td>
                <div class="flex flex-col text-center justify-between h-full w-fit ">
                    <h6>{{ ucfirst($registro->nombre) }}</h6>
                    <small class="pb-1">{{ ucfirst($registro->tipo) }}</small>
                    <span class="pt-1 w-full border-t border-gray-300 ">
                        @for ($i = 0; $i < $registro->estrellas; $i++)
                            <i class="fas fa-star text-[0.7rem]" style="color: gold;"></i>
                        @endfor
                    </span>
                </div>
            </td>
            <td>{{ ucfirst($registro->empresa->nombre) }}</td>
            <td>
                <div class="flex justify-center items-center">
                    <div class="flex flex-col text-center ids gap-1">
                        <h6>{{ ucfirst($registro->habitacion) }}</h6>
                        <small class="camino-text">
                            {{"Maximo ".$registro->capacidad_personas.($registro->capacidad_personas > 0 ? " personas": " persona")}} 
                        </small>
                        <small class="camino-text">Disponibles: {{ $registro->habitaciones_disponibles }}</small>
                    </div>
                </div>
            </td>
            <td>
                <div class="flex items-center flex-col">
                        <span>{{ '$' . number_format($registro->precio_por_noche, 0, ',', '.')}}</span>
                        <small class="camino-text">por noche</small>
                </div>
            </td>
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
                <div class="flex justify-center">
                    <div class="flex flex-col text-center justify-between h-full w-fit ">
                        <span class=" pb-1 mb-1 w-full">
                            {{ number_format($registro->calificacion, 1, '.', ',') }}
                        </span>
                    </div>
                </div>
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
                <x-layouts.administracion.modals.mostrar-registro id={{$id1}} titulo="Descripcion" :detalles="$detalles"/>
            </td>
            <td>
                @php
                    $contacto = [
                        (object)[
                            'titulo' => 'Telefono',
                            'contenido' => $registro->telefono,
                        ],
                        (object)[
                            'titulo' => 'Email',
                            'contenido' => $registro->email,
                        ],
                        (object)[
                            'titulo' => 'Sitio Web',
                            'contenido' => $registro->sitio_web,
                        ],
                        
                    ];
                @endphp
                <x-layouts.administracion.modals.mostrar-registro id={{$id2}} titulo="Contacto" :detalles="$contacto"/>
            </td>
            <td>
                @php
                    $horarios = [
                        (object)[
                            'titulo' => 'Check-in',
                            'contenido' => $registro->check_in->format('H:i'),
                        ],
                        (object)[
                            'titulo' => 'Check-out',
                            'contenido' => $registro->check_out->format('H:i'),
                        ],
                        
                    ];
                @endphp
                <x-layouts.administracion.modals.mostrar-registro id={{$id3}} titulo="Horarios" :detalles="$horarios"/>
            </td>
            <td>
                @php
                    $condiciones = [
                        (object)[
                            'titulo' => '',
                            'contenido' => $registro->condiciones,
                        ]
                    ];
                @endphp
                <x-layouts.administracion.modals.mostrar-registro id={{$id4}} titulo="Condiciones" :detalles="$condiciones"/>
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
            $id2++;
            $id3++;
            $id4++;
        @endphp
    @endforeach
@endif