@extends($layout)

@section('content')
    <article class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
            {{ $post->title }}
        </h1>

        <div class="flex flex-wrap gap-4 mb-6 text-sm text-gray-600">
            @if($post->authors->isNotEmpty())
                <div class="flex items-center gap-2">
                    <span class="font-semibold">{{ __('Szerzők:') }}</span>
                    @foreach($post->authors as $author)
                        <a href="{{ route('cms.author.show', $author->slug) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $author->name }}
                        </a>@if(!$loop->last), @endif
                    @endforeach
                </div>
            @endif

            @if($post->postGroups->isNotEmpty())
                <div class="flex items-center gap-2">
                    <span class="font-semibold">{{ __('Csoportok:') }}</span>
                    @foreach($post->postGroups as $group)
                        <a href="{{ route('cms.post-group.show', $group->slug) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                            {{ $group->name }}
                        </a>@if(!$loop->last), @endif
                    @endforeach
                </div>
            @endif

            <div class="flex items-center gap-2">
                <span class="font-semibold">{{ __('Dátum:') }}</span>
                <span>{{ $post->created_at->format('Y.m.d. H:i') }}</span>
            </div>
        </div>
        @if($post->main_image_url)
            <img
                src="{{ $post->main_image_url }}"
                alt="{{ $post->title }}"
                class="w-full h-auto rounded-lg mb-6 object-cover"
            >
        @endif


        @if($post->lead)
            <p class="mb-8 px-5 py-4 rounded-lg border-l-4 border-blue-500 bg-blue-50 text-lg lg:text-xl font-medium text-gray-900">
                {{ $post->lead }}
            </p>
        @endif

        <div class="prose prose-lg max-w-none">
            <x-cms-content :content="$post->content" />
        </div>
    </article>
@endsection
