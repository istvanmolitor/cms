<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
    @if($post->main_image_url)
        <a href="{{ route('cms.post.show', $post->slug) }}">
            <img src="{{ $post->main_image_url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover hover:opacity-90 transition-opacity">
        </a>
    @endif
    <div class="p-5">
        <h3 class="text-xl font-semibold mb-2">
            <a href="{{ route('cms.post.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                {{ $post->title }}
            </a>
        </h3>
        @if($post->lead)
            <p class="text-gray-600 text-sm line-clamp-3">
                {{ $post->lead }}
            </p>
        @endif
        <div class="mt-4 flex items-center justify-between text-sm text-gray-400">
            <span>{{ $post->created_at->format('Y.m.d.') }}</span>
            <a href="{{ route('cms.post.show', $post->slug) }}" class="font-medium text-blue-500 hover:text-blue-700">
                {{ __('Olvasd tovább') }} &rarr;
            </a>
        </div>
    </div>
</div>
