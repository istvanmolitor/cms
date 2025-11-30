@props(['item'])

{{-- Desktop version (horizontal) --}}
<div class="relative group hidden md:block">
    <a href="{{ $item->url }}"
       class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition-colors inline-flex items-center"
       @if($item->is_external) target="_blank" rel="noopener noreferrer" @endif>
        @if($item->icon)
            <span class="mr-1">
                @svg($item->icon, 'w-4 h-4')
            </span>
        @endif
        <span>{{ $item->label }}</span>
        @if($item->children->count() > 0)
            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        @endif
    </a>

    @if($item->children->count() > 0)
        <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block z-50">
            @foreach($item->children as $child)
                <a href="{{ $child->url }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors"
                   @if($child->is_external) target="_blank" rel="noopener noreferrer" @endif>
                    @if($child->icon)
                        <span class="mr-2">@svg($child->icon, 'w-4 h-4 inline')</span>
                    @endif
                    {{ $child->label }}
                </a>
            @endforeach
        </div>
    @endif
</div>

{{-- Mobile version (vertical) --}}
<div class="md:hidden">
    <a href="{{ $item->url }}"
       class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium hover:bg-gray-50 rounded transition-colors flex items-center justify-between"
       @if($item->is_external) target="_blank" rel="noopener noreferrer" @endif
       @if($item->children->count() > 0)
           onclick="event.preventDefault(); this.nextElementSibling.classList.toggle('hidden');"
       @endif>
        <span class="flex items-center">
            @if($item->icon)
                <span class="mr-2">@svg($item->icon, 'w-4 h-4')</span>
            @endif
            {{ $item->label }}
        </span>
        @if($item->children->count() > 0)
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        @endif
    </a>

    @if($item->children->count() > 0)
        <div class="hidden pl-4 space-y-1">
            @foreach($item->children as $child)
                <a href="{{ $child->url }}"
                   class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm hover:bg-gray-50 rounded transition-colors flex items-center"
                   @if($child->is_external) target="_blank" rel="noopener noreferrer" @endif>
                    @if($child->icon)
                        <span class="mr-2">@svg($child->icon, 'w-4 h-4')</span>
                    @endif
                    {{ $child->label }}
                </a>
            @endforeach
        </div>
    @endif
</div>

