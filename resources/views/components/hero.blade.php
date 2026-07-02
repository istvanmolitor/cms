@if($image_src)
    <div class="relative overflow-hidden shadow-lg min-h-[32rem]">
        <img src="{{ $image_src }}" alt="{{ $title }}" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-end h-full min-h-[32rem] p-8">
            @if($link)
                <a href="{{ $link }}" class="block">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 hover:text-gray-200 transition-colors">
                        {{ $title }}
                    </h1>
                </a>
            @else
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">
                    {{ $title }}
                </h1>
            @endif
            @if($lead)
                <p class="text-lg text-gray-200 mb-6 max-w-3xl line-clamp-3">{{ $lead }}</p>
            @endif
            @isset($meta)
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-300">
                    {{ $meta }}
                    @if($link)
                        <a href="{{ $link }}" class="ml-auto font-semibold text-white hover:text-gray-200 transition-colors">
                            {{ $linkText ?? __('Olvasd tovább') }} &rarr;
                        </a>
                    @endif
                </div>
            @elseif($link)
                <a href="{{ $link }}" class="font-semibold text-white hover:text-gray-200 transition-colors">
                    {{ $linkText ?? __('Olvasd tovább') }} &rarr;
                </a>
            @endif
        </div>
    </div>
@else
    <div class="bg-gray-50 p-8 md:p-12">
        @if($link)
            <a href="{{ $link }}" class="block">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 hover:text-blue-700 transition-colors">
                    {{ $title }}
                </h1>
            </a>
        @else
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                {{ $title }}
            </h1>
        @endif
        @if($lead)
            <p class="text-lg text-gray-600 mb-6 max-w-3xl">{{ $lead }}</p>
        @endif
        @isset($meta)
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                {{ $meta }}
                @if($link)
                    <a href="{{ $link }}" class="ml-auto font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                        {{ $linkText ?? __('Olvasd tovább') }} &rarr;
                    </a>
                @endif
            </div>
        @elseif($link)
            <a href="{{ $link }}" class="font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                {{ $linkText ?? __('Olvasd tovább') }} &rarr;
            </a>
        @endif
    </div>
@endif
