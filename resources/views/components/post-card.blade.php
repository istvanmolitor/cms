<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
    @if($post->main_image_url)
        <a href="{{ route('cms.post.show', $post->slug) }}">
            <img src="{{ $post->main_image_url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover hover:opacity-90 transition-opacity">
        </a>
    @else
        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
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
