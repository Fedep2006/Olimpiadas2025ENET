<style>
    .content-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
    }

    .search-filters {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .filter-row {
        display: flex;
        gap: 15px;
        align-items: end;
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }
    .form-control,
    .form-select {
        width: 100%;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.65rem 1rem;
        transition: all 0.3s ease;
    }
</style>
<!-- Filters -->
<div class="content-card">
    <h4 class="card-title mb-3">Barra de Busqueda</h5>
    <div class="search-filters">
        
        <form id="searchForm" class="filter-row" data-inputs='@json($inputs)'>
            @php $i = 0; @endphp
            @foreach ( $inputs as $input)
                <div class="filter-group">
                    <label class="form-label">{{$input->label ?? ''}}</label>
                    <div class="input-group" data-input-id-{{$i}}="{{$input->id}}">
                                                        @switch($input->type)
                                @case("select")
                                    <select 
                                        class="form-select" 
                                        name="{{$input->name ?? $input->id}}" 
                                        id="{{$input->id  ?? ""}}" 
                                        value="{{request($input->value)}}" 
                                        placeholder="{{$input->placeholder ?? ''}}"
                                    >
                                        <option value="">-- Seleccionar --</option>
                                        @foreach ($input->options as $option)
                                            <option value="{{$option->value}}">{{$option->text}}</option>
                                        @endforeach
                                    </select>
                                    @break
                                @case("checkbox")
                                    <div class="form-check">
                                        <input type="hidden" name="activo" value="false">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox"
                                            value="true"
                                            id="{{$input->id  ?? ""}}" 
                                            name="{{$input->name ?? $input->id}}" 
                                             checked
                                        >
                                        <label class="form-check-label" for="{{$input->name ?? $input->id}}" >
                                            {{$input->label ?? ""}}
                                        </label>
                                    </div>
                                    @break
                            
                                @default
                                    <input 
                                        type="{{$input->type ?? ""}}" 
                                        step="{{$input->step ?? ""}}"
                                        class="form-control" 
                                        id="{{$input->id  ?? ""}}" 
                                        name="{{$input->name ?? $input->id}}" 
                                        placeholder="{{$input->placeholder ?? ''}}" 
                                        value="{{request($input->value)}}" 
                                        min="{{$input->min ?? ""}}"
                                        max="{{$input->max ?? ""}}"
                                    > 
                            @endswitch
                    </div>
                </div>
                            
                @php $i++; @endphp
            @endforeach
            <div class="filter-group">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin">
                        <i class="fas fa-search"></i>
                        Buscar
                    </button>
                    <button type="button" class="btn-admin" style="background-color: #6c757d;" id="clearFilters">
                        <i class="fas fa-times"></i>
                        Limpiar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
