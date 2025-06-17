@props(['titulo', 'inputs' => []])
<div class="modal" id="editarRegistroModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            <div class="modal-header">
                <h5 class="modal-title">{{ $titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editarRegistroForm">
                    <input type="hidden" id="editId" name="registro_id">

                    @foreach ( $inputs as $input)
                        <div class="mb-3{{$input->type == "checkbox" ? ' flex flex-row gap-3' : ''}}" style="{{$input->type == "checkbox" ? 'justify-content: flex-start' : ''}}">
                            <label 
                                for="{{ $input->name ?? $input->name}}" 
                                class="form-label">{{$input->label ?? ""}}
                            </label>
                            @switch($input->type)
                                @case("select")
                                    <select class="form-select" name="{{ $input->name ?? $input->id }}" id="{{ $input->id ?? '' }}" required>
                                        @foreach ($input->options as $option)
                                            <option value="{{ $option->value }}">{{ $option->text }}</option>
                                        @endforeach
                                    </select>
                                    @break
                                @case("checkbox")
                                    <input type="hidden" name="activo" value='false'>
                                    <input 
                                        type="checkbox" 
                                        class="form-check-input" 
                                        value="true"
                                        id="{{$input->id ?? ''}}" 
                                        name="{{$input->name ?? $input->id}}"
                                    >
                                    
                                    @break
                            
                                @default
                                    <input 
                                        type="{{$input->type ?? ""}}" 
                                        step="{{$input->step ?? ""}}"
                                        class="form-control" 
                                        id="{{$input->id  ?? ""}}" 
                                        name="{{$input->name ?? $input->id}}" 
                                        required
                                    >
                            @endswitch
                        </div>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="actualizarRegistro">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
