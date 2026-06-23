@props(['paginator'])

@if($paginator->hasPages())
    <nav class="flex items-center justify-between mt-8" aria-label="{{ __('Lapozó') }}">
        <div class="text-sm text-gray-500">
            {{ __(':from–:to / :total bejegyzés', [
                'from' => $paginator->firstItem(),
                'to'   => $paginator->lastItem(),
                'total'=> $paginator->total(),
            ]) }}
        </div>

        <div class="flex items-center gap-1">
            {{-- Előző oldal --}}
            @if($paginator->onFirstPage())
                <span class="px-3 py-1.5 text-sm text-gray-300 border border-gray-200 rounded cursor-not-allowed">
                    &laquo;
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="px-3 py-1.5 text-sm text-gray-600 border border-gray-200 rounded hover:bg-gray-50 transition-colors"
                   rel="prev">
                    &laquo;
                </a>
            @endif

            {{-- Oldalszámok --}}
            @foreach($paginator->getUrlRange(
                max(1, $paginator->currentPage() - 2),
                min($paginator->lastPage(), $paginator->currentPage() + 2)
            ) as $page => $url)
                @if($page === $paginator->currentPage())
                    <span class="px-3 py-1.5 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                       class="px-3 py-1.5 text-sm text-gray-600 border border-gray-200 rounded hover:bg-gray-50 transition-colors">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            {{-- Következő oldal --}}
            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="px-3 py-1.5 text-sm text-gray-600 border border-gray-200 rounded hover:bg-gray-50 transition-colors"
                   rel="next">
                    &raquo;
                </a>
            @else
                <span class="px-3 py-1.5 text-sm text-gray-300 border border-gray-200 rounded cursor-not-allowed">
                    &raquo;
                </span>
            @endif
        </div>
    </nav>
@endif
