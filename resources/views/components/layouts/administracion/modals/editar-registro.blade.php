@props(['titulo', 'inputs' => []])
<div class="modal" id="editarRegistroModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editarRegistroForm">
                    <input type="hidden" id="editId" name="registro_id">

                    @foreach ( $inputs as $input)
                            @if ( $input->type !== "select")
                                <label 
                                    for="{{ $input->name ?? $input->name}}" 
                                    class="form-label">{{$input->label ?? ""}}
                                </label>
                                <input 
                                    type="{{$input->type ?? ""}}" 
                                    step="{{$input->step ?? ""}}"
                                    class="form-control" 
                                    id="{{$input->id  ?? ""}}" 
                                    name="{{$input->name ?? $input->id}}" 
                                    required
                                > 
                            @else
                                <label 
                                    for="{{ $input->name ?? $input->name}}" 
                                    class="form-label">{{$input->label ?? ""}}
                                </label>
                                <select 
                                    class="form-select" 
                                    name="{{$input->name ?? $input->id}}" 
                                    id="{{$input->id  ?? ""}}" 
                                    required
                                >
                                    @foreach ($input->options as $option)
                                        <option value="{{$option->value}}">{{$option->text}}</option>
                                    @endforeach
                                </select>
                            @endif
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
