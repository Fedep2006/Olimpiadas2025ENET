@props(['titulo', 'inputs' => []])
<div class="modal" id="nuevoRegistroModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            <div class="modal-header">
                <h5 class="modal-title">{{ $titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoRegistroForm">
                    @foreach ($inputs as $input)
                        <div class="mb-3{{ $input->type == 'checkbox' ? ' flex flex-row gap-3' : '' }}"
                            style="{{ $input->type == 'checkbox' ? 'justify-content: flex-start' : '' }}">
                            <label for="{{ $input->name ?? $input->name }}" class="form-label">{{ $input->label ?? '' }}
                            </label>
                            @switch($input->type)
                                @case('select')
                                    <select class="form-select" name="{{ $input->name ?? $input->id }}"
                                        id="{{ $input->id ?? '' }}" required>
                                        @foreach ($input->options as $option)
                                            <option value="{{ $option->value }}">{{ $option->text }}</option>
                                        @endforeach
                                    </select>
                                @break

                                @case('checkbox')
                                    <div class="form-check">
                                        <input type="hidden" name="activo" value="0">
                                        <input type="hidden" name="disponible" value="0">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="{{ $input->id ?? '' }}" name="{{ $input->name ?? $input->id }}" checked>
                                    </div>
                                @break

                                @case('button')
                                    <!-- Botón para agregar inputs dinámicos -->
                                    <div class="mb-3 text-center">
                                        <button type="button" class="add-inputs-btn" id="addInputsBtn">
                                            <i class="fas fa-plus me-2"></i>Agregar Contenido al Paquete
                                        </button>
                                    </div>

                                    <!-- Contenedor para inputs dinámicos -->
                                    <div id="dynamicInputsContainer" class="dynamic-inputs-container">
                                        <!-- Los inputs dinámicos se agregarán aquí -->
                                    </div>
                                @break

                                @default
                                    <input type="{{ $input->type ?? '' }}" step="{{ $input->step ?? '' }}"
                                        class="form-control" id="{{ $input->id ?? '' }}"
                                        name="{{ $input->name ?? $input->id }}" step="{{ $input->step ?? '' }}"
                                        min="{{ $input->min ?? '' }}" max="{{ $input->max ?? '' }}" required>
                            @endswitch

                        </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarRegistro">Guardar Registro</button>
            </div>
        </div>
    </div>
</div>
