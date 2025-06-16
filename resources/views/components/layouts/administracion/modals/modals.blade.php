<style>
    :root {
        --padding-mobile: 1rem;
        --padding-desktop: 2rem;
        --font-sm: 0.9rem;
        --font-md: 1rem;
        --font-lg: 1.25rem;
    }
    .modal-dialog {
        display: flex;
        justify-content: center;
        align-items: center;
        min-width: 100vw;
        width: 100vw;
        height: 100vh;
        margin: 0;
    }

    .modal form {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 10px;
    }
    .modal form[data-items="5"],
    .modal form[data-items="6"],
    .modal form[data-items="7"],
    .modal form[data-items="8"],
    .modal form[data-items="9"],
    .modal form[data-items="10"],
    .modal form[data-items="11"],
    .modal form[data-items="12"],
    .modal form[data-items="13"],
    .modal form[data-items="14"],
    .modal form[data-items="15"],
    .modal form[data-items="16"] {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .modal .form-label {
        font-weight: 500;
        color: var(--despegar-blue);
        margin-bottom: 0.5rem;
        text-align: start;
        font-size: var(--font-sm);
    }

    .modal .form-control,
    .form-select {
        width: 100%;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: var(--font-sm);
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
        font-size: var(--font-sm);
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
        display: flex;
        width: 100%;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 1rem !important;
    }

    /* Modal Styles */
    .modal-content {
        width: 90%;
        max-height: 90vh;
        height: auto;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        font-size: var(--font-sm);
    }

    .modal-header {
        background: linear-gradient(180deg, var(--despegar-blue) 0%, #004499 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: var(--padding-mobile);
        border: none;
        font-size: var(--font-md);
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }


    .modal-header .modal-title {
        font-weight: 600;
        font-size: var(--font-md);
        text-align: center;
        width: 100%;
    }

    .modal-body {
        width: 100%;
        padding: var(--padding-mobile);
        overflow-y: auto;
        flex: 1;
    }

    .modal-footer {
        padding: var(--padding-mobile);
        border-top: 1px solid #e9ecef;
        background-color: #f8f9fa;
        border-radius: 0 0 15px 15px;
    }

    .form-label {
        font-weight: 500;
        color: var(--despegar-blue);
        margin-bottom: 5px;
        text-align: center;
    }
    @media (min-width: 768px) {
    .modal-content {
        font-size: var(--font-md);
        width: 70%;
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        padding: var(--padding-desktop);
    }

    .modal form[data-items="5"],
    .modal form[data-items="6"],
    .modal form[data-items="7"],
    .modal form[data-items="8"] {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    .modal form[data-items="9"],
    .modal form[data-items="10"],
    .modal form[data-items="11"],
    .modal form[data-items="12"] {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
    .modal form[data-items="13"],
    .modal form[data-items="14"],
    .modal form[data-items="15"],
    .modal form[data-items="16"] {
        grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .modal-content[data-items="6"],
    .modal-content[data-items="7"],
    .modal-content[data-items="8"],
    .modal-content[data-items="9"],
    .modal-content[data-items="10"] {
        width: 80%;
    }

    .modal-content[data-items="11"],
    .modal-content[data-items="12"],
    .modal-content[data-items="13"],
    .modal-content[data-items="14"],
    .modal-content[data-items="15"] {
        width: 90%;
    }
    @media (min-width: 1024px) {

    .modal-content {
        font-size: var(--font-md);
        width: 35%;
    }

    .modal-content[data-items="6"],
    .modal-content[data-items="7"],
    .modal-content[data-items="8"],
    .modal-content[data-items="9"],
    .modal-content[data-items="10"] {
        width: 50%;
    }

    .modal-content[data-items="11"],
    .modal-content[data-items="12"],
    .modal-content[data-items="13"],
    .modal-content[data-items="14"],
    .modal-content[data-items="15"] {
        width: 60%;
    }

    .modal .form-label,
    .modal .form-control,
    .modal .btn {
        font-size: var(--font-md);
    }
}
}
</style>
@props(['tituloCrear','tituloEditar','tituloEliminar', 'camposCrear', 'camposEditar'])

<x-layouts.administracion.modals.crear-registro :titulo="$tituloCrear" :inputs="$camposCrear" />

<x-layouts.administracion.modals.editar-registro :titulo="$tituloEditar" :inputs="$camposEditar"/>

<x-layouts.administracion.modals.eliminar-registro :titulo="$tituloEliminar" />

@vite(['resources/js/administracion/modals/modals.js'])
