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
        <form id="searchForm" class="filter-row">
            <div class="filter-group">
                <label class="form-label">Buscar Usuario</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="search" id="searchInput"
                        placeholder="Nombre, email o ID de usuario" value="{{ request('search') }}" autocomplete="off">
                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="filter-group">
                <label class="form-label">Fecha de Registro</label>
                <input type="date" class="form-control" name="registration_date"
                    value="{{ request('registration_date') }}">
            </div>
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
