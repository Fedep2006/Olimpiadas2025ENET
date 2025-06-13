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
</style>
<!-- Filters -->
<div class="content-card">
    <div class="search-filters">
        <form id="searchForm" class="filter-row" data-inputs='@json($inputs)'>
            @php $i = 0; @endphp
            @foreach ( $inputs as $input)
                <div class="filter-group">
                    <label class="form-label">{{$input->label ?? ''}}</label>
                    <div class="input-group" data-input-id-{{$i}}="{{$input->id}}">
                        <input 
                            type="{{$input->type ?? ''}}" 
                            class="form-control" 
                            name="{{$input->name ?? ''}}" 
                            id="{{$input->id ?? ''}}"
                            placeholder="{{$input->placeholder ?? ''}}" 
                            value="{{request($input->value)}}" 
                            autocomplete="off">
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
