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
                $end = min($users->lastPage(), values: $users->currentPage() + 2);
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
