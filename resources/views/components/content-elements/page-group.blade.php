<div class="content-element content-element-page-group mb-8">
    @if($pages->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pages as $page)
                <div class="page-card bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    @if($page->main_image_url)
                        <a href="{{ route('cms.page.show', $page->slug) }}" class="block aspect-video bg-gray-100">
                            <img src="{{ $page->main_image_url }}" alt="{{ $page->title }}" class="w-full h-full object-cover">
                        </a>
                    @endif
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">
                            <a href="{{ route('cms.page.show', $page->slug) }}" class="text-gray-900 hover:text-blue-600">
                                {{ $page->title }}
                            </a>
                        </h3>
                        @if($page->lead)
                            <p class="text-gray-600 line-clamp-3 mb-4">
                                {{ $page->lead }}
                            </p>
                        @endif
                        <a href="{{ route('cms.page.show', $page->slug) }}" class="text-blue-600 font-medium hover:underline text-sm inline-flex items-center">
                            {{ __('Read more') }}
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic">{{ __('No pages found in this group.') }}</p>
    @endif
</div>
