@if ($paginator->hasPages())
    <nav class="gt-pagination" role="navigation" aria-label="Pagination Navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="gt-page disabled">← Prev</span>
        @else
            <a class="gt-page" href="{{ $paginator->previousPageUrl() }}" rel="prev">← Prev</a>
        @endif

        <span class="gt-page current">
            Page {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="gt-page" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a>
        @else
            <span class="gt-page disabled">Next →</span>
        @endif
    </nav>
@endif