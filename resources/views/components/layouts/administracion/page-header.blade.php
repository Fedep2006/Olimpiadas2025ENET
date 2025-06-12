<style>
    .page-header {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .page-title {
        color: var(--despegar-blue);
        font-size: 1.8rem;
        font-weight: bold;
        margin: 0;
    }

    .page-subtitle {
        color: #6c757d;
        margin: 5px 0 0 0;
    }

    .btn-admin {
        background-color: var(--despegar-blue);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-admin:hover {
        background-color: #0052a3;
        color: white;
    }

    .btn-admin.orange {
        background-color: var(--despegar-orange);
    }

    .btn-admin.success {
        background-color: #28a745;
    }

    .btn-admin.danger {
        background-color: #dc3545;
    }
</style>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">{{ $titulo }}</h1>
            <p class="page-subtitle">{{ $contenido }}</p>
        </div>
        <button class="btn-admin orange">
            <i class="fas fa-user-plus"></i>
            {{ $botonNombre ?? 'Acción' }}
        </button>
    </div>
</div>
