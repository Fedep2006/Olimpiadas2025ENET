@props(['titulo', 'inputs' => []])
<div class="modal" id="nuevoRegistroModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="nuevoRegistroForm">
                    @foreach ( $inputs as $input)
                        <div class="mb-3">
                            <label 
                                for="{{ $input->name ?? $input->name}}" 
                                class="form-label">{{$input->label ?? ""}}
                            </label>
                            <input 
                                type="{{$input->type ?? ""}}" 
                                class="form-control" 
                                id="{{$input->id  ?? ""}}" 
                                name="{{$input->name ?? $input->id}}" 
                                required
                            > 
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
