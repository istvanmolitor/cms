@if($post->main_image_url)
    <div class="relative overflow-hidden shadow-lg min-h-[32rem]">
        <img src="{{ $post->main_image_url }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-end h-full min-h-[32rem] p-8">
            <a href="{{ route('cms.post.show', $post->slug) }}" class="block">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 hover:text-gray-200 transition-colors">
                    {{ $post->title }}
                </h1>
            </a>
            @if($post->lead)
                <p class="text-lg text-gray-200 mb-6 max-w-3xl line-clamp-3">{{ $post->lead }}</p>
            @endif
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-300">
                <span>{{ $post->created_at->format('Y.m.d.') }}</span>
                @if($post->relationLoaded('authors') && $post->authors->isNotEmpty())
                    <span>&bull;</span>
                    <span>{{ $post->authors->pluck('name')->implode(', ') }}</span>
                @endif
                @if($link)
                <a href="{{ route('cms.post.show', $post->slug) }}" class="ml-auto font-semibold text-white hover:text-gray-200 transition-colors">
                    {{ __('Olvasd tovább') }} &rarr;
                </a>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="bg-gray-50 p-8 md:p-12">
        <a href="{{ route('cms.post.show', $post->slug) }}" class="block">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 hover:text-blue-700 transition-colors">
                {{ $post->title }}
            </h1>
        </a>
        @if($post->lead)
            <p class="text-lg text-gray-600 mb-6 max-w-3xl">{{ $post->lead }}</p>
        @endif
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
            <span>{{ $post->created_at->format('Y.m.d.') }}</span>
            @if($post->relationLoaded('authors') && $post->authors->isNotEmpty())
                <span>&bull;</span>
                <span>{{ $post->authors->pluck('name')->implode(', ') }}</span>
            @endif
            @if($link)
                <a href="{{ route('cms.post.show', $post->slug) }}" class="ml-auto font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                    {{ __('Olvasd tovább') }} &rarr;
                </a>
            @endif
        </div>
    </div>
@endif
