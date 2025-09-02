@php
    $query = request()->except('page');
    $queryString = http_build_query($query);
@endphp

@if ($paginator->lastPage() > 1)
    <div class="row">
        <ul class="pagination pagination-lg justify-content-end">
            {{-- Previous --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark"
                    href="{{ $paginator->previousPageUrl() ? '?' . $queryString . '&page=' . ($paginator->currentPage() - 1) : '#' }}">
                    &laquo;
                </a>
            </li>

            {{-- Page numbers --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark"
                        href="?{{ $queryString }}&page={{ $i }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor

            {{-- Next --}}
            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark"
                    href="{{ $paginator->nextPageUrl() ? '?' . $queryString . '&page=' . ($paginator->currentPage() + 1) : '#' }}">
                    &raquo;
                </a>
            </li>
        </ul>
    </div>
@endif