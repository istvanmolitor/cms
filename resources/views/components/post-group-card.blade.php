<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
    @if($postGroup->main_image_url)
        <a href="{{ route('cms.post-group.show', $postGroup->slug) }}">
            <img src="{{ $postGroup->main_image_url }}" alt="{{ $postGroup->name }}" class="w-full h-48 object-cover hover:opacity-90 transition-opacity">
        </a>
    @else
        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
    @endif
    <div class="p-5">
        <h3 class="text-xl font-semibold mb-2">
            <a href="{{ route('cms.post-group.show', $postGroup->slug) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                {{ $postGroup->name }}
            </a>
        </h3>
        @if($postGroup->lead)
            <p class="text-gray-600 text-sm line-clamp-3">
                {{ $postGroup->lead }}
            </p>
        @endif
        <div class="mt-4 flex items-center justify-end text-sm text-gray-400">
            <a href="{{ route('cms.post-group.show', $postGroup->slug) }}" class="font-medium text-blue-500 hover:text-blue-700">
                {{ __('Megtekintés') }} &rarr;
            </a>
        </div>
    </div>
</div>
