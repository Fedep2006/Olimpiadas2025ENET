<style>
    .pagination {
        display: flex;
        gap: 4px;
        align-items: center;
        margin: 0;
        padding: 0;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination .page-item {
        list-style: none;
        margin: 0;
    }

    .pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 8px;
        border-radius: 6px;
        border: 1px solid #e9ecef;
        background-color: white;
        color: var(--despegar-blue);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.9rem;
    }

    .pagination .page-link:hover {
        background-color: var(--despegar-light-blue);
        border-color: var(--despegar-blue);
        transform: translateY(-1px);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--despegar-blue);
        border-color: var(--despegar-blue);
        color: white;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #f8f9fa;
        border-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
    }

    .pagination-info {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0 15px;
        text-align: center;
    }

    .pagination .page-link i {
        font-size: 0.8rem;
    }

    .pagination .page-link.prev,
    .pagination .page-link.next {
        padding: 0 12px;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 100px;
        height: 36px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .pagination .page-link.prev i,
    .pagination .page-link.next i {
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1em;
        height: 1em;
        line-height: 1;
    }

    .pagination .page-link.prev span,
    .pagination .page-link.next span {
        display: inline-flex;
        align-items: center;
        line-height: 1;
    }

    .pagination .page-item.disabled .page-link.prev,
    .pagination .page-item.disabled .page-link.next {
        background-color: #f8f9fa;
        border-color: #e9ecef;
        color: #6c757d;
        cursor: not-allowed;
        opacity: 0.65;
    }

    .pagination .page-item.disabled .page-link.prev i,
    .pagination .page-item.disabled .page-link.next i {
        opacity: 0.65;
    }
</style>
@if ($users->hasPages())
    <nav aria-label="Navegación de páginas">
        <ul class="pagination">
            {{-- Botón Anterior --}}
            @if ($users->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link prev">
                        <i class="fas fa-chevron-left"></i>
                        <span>Anterior</span>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link prev" href="{{ $users->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left"></i>
                        <span>Anterior</span>
                    </a>
                </li>
            @endif
                        {{-- Números de Página --}}
            @php
                $start = max(1, $users->currentPage() - 2);
                $end = min($users->lastPage(), $users->currentPage() + 2);
            @endphp

            {{-- Primera página --}}
            @if ($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $users->url(1) }}">1</a>
                </li>
                @if ($start > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            {{-- Páginas alrededor de la actual --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $users->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Última página --}}
            @if ($end < $users->lastPage())
                @if ($end < $users->lastPage() - 1)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a>
                </li>
            @endif

            {{-- Botón Siguiente --}}
            @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link next" href="{{ $users->nextPageUrl() }}" rel="next">
                        <i class="fas fa-chevron-right"></i>
                        <span>Siguiente</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link next">
                        <i class="fas fa-chevron-right"></i>
                        <span>Siguiente</span>
                    </span>
                </li>
            @endif
            
        </ul>
    </nav>
@endif
