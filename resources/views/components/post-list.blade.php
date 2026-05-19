<div class="space-y-6">
    @foreach($posts as $post)
        <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0 flex flex-col md:flex-row gap-6">
            @if($post->main_image_url)
                <div class="w-full md:w-1/3 lg:w-1/4 shrink-0">
                    <a href="{{ route('cms.post.show', $post->slug) }}">
                        <img src="{{ $post->main_image_url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-lg shadow-sm hover:opacity-90 transition-opacity">
                    </a>
                </div>
            @endif
            <div class="flex-1">
                <h3 class="text-2xl font-semibold mb-2">
                    <a href="{{ route('cms.post.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                        {{ $post->title }}
                    </a>
                </h3>
                @if($post->lead)
                    <p class="text-gray-600 line-clamp-3">
                        {{ $post->lead }}
                    </p>
                @endif
                <div class="mt-4 text-sm text-gray-500">
                    <span>{{ $post->created_at->format('Y.m.d. H:i') }}</span>
                </div>
                <div class="mt-2">
                    <a href="{{ route('cms.post.show', $post->slug) }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                        {{ __('Olvasd tovább') }} &rarr;
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
