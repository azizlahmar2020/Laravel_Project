@if ($paginator->hasPages())
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true">
                <span class="page-link"></span>
            </li>
        @else
            <li>
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                </a>
            </li>
        @else
            <li class="disabled" aria-disabled="true">
                <span class="page-link"></span>
            </li>
        @endif
    </ul>
@endif

<style>
    .small-icon {
        font-size: 0.6rem !important; /* Taille de l'icône */
    }
    .pagination .page-link {
        padding: 0.25rem 0.5rem; /* Réduire le padding pour un aspect plus compact */
    }
</style>
