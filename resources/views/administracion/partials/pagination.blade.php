@if ($users->hasPages())
    <nav aria-label="Navegación de páginas">
        <ul class="pagination">
            {{-- Botón Anterior --}}
            @if ($users->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fas fa-chevron-left"></i>
                        Anterior
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link prev" href="{{ $users->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left"></i>
                        Anterior
                    </a>
                </li>
            @endif

            {{-- Números de Página --}}
            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if ($page == $users->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Botón Siguiente --}}
            @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link next" href="{{ $users->nextPageUrl() }}" rel="next">
                        Siguiente
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">
                        Siguiente
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
