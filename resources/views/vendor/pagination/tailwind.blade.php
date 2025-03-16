@if ($paginator->hasPages())
    <div class="flex justify-between items-center py-4">
        {{-- Mobile Navigation --}}
        <div class="flex justify-between w-full sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="btn btn-disabled">{!! __('pagination.previous') !!}</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-outline">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-outline">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="btn btn-disabled">{!! __('pagination.next') !!}</span>
            @endif
        </div>

        {{-- Desktop Navigation --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
            <p class="text-sm text-gray-700 dark:text-gray-400">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>

            {{-- Pagination --}}
            <div class="join">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <button class="join-item btn btn-disabled">❮</button>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn btn-outline">❮</a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <button class="join-item btn btn-disabled">{{ $element }}</button>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button class="join-item btn btn-primary">{{ $page }}</button>
                            @else
                                <a href="{{ $url }}" class="join-item btn btn-outline">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn btn-outline">❯</a>
                @else
                    <button class="join-item btn btn-disabled">❯</button>
                @endif
            </div>
        </div>
    </div>
@endif
