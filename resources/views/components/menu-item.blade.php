@props(['item'])

<div class="relative group hidden md:block">
    <a href="{{ $item->getUrl() }}"
       class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors inline-flex items-center"
       @if($item->isExternal()) target="_blank" rel="noopener noreferrer" @endif>
        @if($item->getIcon())
            <span class="mr-1">
                @svg($item->getIcon(), 'w-4 h-4')
            </span>
        @endif
        <span>{{ $item->getLabel() }}</span>
        @if($item->count() > 0)
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        @endif
    </a>

    @if($item->count() > 0)
        <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block z-50">
            @foreach($item->getMenuItems() as $child)
                <a href="{{ $child->getUrl() }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                   @if($child->isExternal()) target="_blank" rel="noopener noreferrer" @endif>
                    @if($child->getIcon())
                        <span class="mr-2">@svg($child->getIcon(), 'w-4 h-4 inline')</span>
                    @endif
                    {{ $child->getLabel() }}
                </a>
            @endforeach
        </div>
    @endif
</div>
