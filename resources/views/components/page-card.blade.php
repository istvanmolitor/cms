<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
    @if($page->main_image_url)
        <a href="{{ route('cms.page.show', $page->slug) }}">
            <img src="{{ $page->main_image_url }}" alt="{{ $page->title }}" class="w-full h-48 object-cover hover:opacity-90 transition-opacity">
        </a>
    @else
        <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
    @endif
    <div class="p-5">
        <h3 class="text-xl font-semibold mb-2">
            <a href="{{ route('cms.page.show', $page->slug) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                {{ $page->title }}
            </a>
        </h3>
        @if($page->lead)
            <p class="text-gray-600 text-sm line-clamp-3">
                {{ $page->lead }}
            </p>
        @endif
        <div class="mt-4 flex items-center justify-end text-sm text-gray-400">
            <a href="{{ route('cms.page.show', $page->slug) }}" class="font-medium text-blue-500 hover:text-blue-700">
                {{ __('Tovább') }} &rarr;
            </a>
        </div>
    </div>
</div>
