<style>
    .modal .form-label {
        color: var(--despegar-blue);
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .modal .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .modal .form-control:focus {
        border-color: var(--despegar-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.15);
    }

    .modal .btn {
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .modal .btn-primary {
        background-color: var(--despegar-blue);
        border: none;
    }

    .modal .btn-primary:hover {
        background-color: #0052a3;
        transform: translateY(-1px);
    }

    .modal .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .modal .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-1px);
    }

    .modal .mb-3 {
        margin-bottom: 1.5rem !important;
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background: linear-gradient(180deg, var(--despegar-blue) 0%, #004499 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 1.5rem;
        border: none;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-header .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-footer {
        padding: 1.5rem;
        border-top: 1px solid #e9ecef;
        background-color: #f8f9fa;
        border-radius: 0 0 15px 15px;
    }

    .form-label {
        font-weight: 500;
        color: var(--despegar-blue);
        margin-bottom: 5px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 12px;
    }
</style>
@props(['tituloCrear','tituloEditar','tituloEliminar', 'camposCrear', 'camposEditar'])

<x-layouts.administracion.modals.crear-registro :titulo="$tituloCrear" :inputs="$camposCrear" />

<x-layouts.administracion.modals.editar-registro :titulo="$tituloEditar" :inputs="$camposEditar"/>

<x-layouts.administracion.modals.eliminar-registro :titulo="$tituloEliminar" />

@vite(['resources/js/administracion/modals/modals.js'])
