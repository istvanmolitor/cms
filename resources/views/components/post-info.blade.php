<div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-gray-600 border-y border-gray-200 py-3 my-4">
    <div class="flex items-center gap-1.5">
        <span class="font-semibold text-gray-700">{{ __('Dátum:') }}</span>
        <span>{{ $post->created_at->format('Y.m.d. H:i') }}</span>
    </div>

    @if($post->authors->isNotEmpty())
    <div class="flex items-center gap-1.5">
        <span class="font-semibold text-gray-700">{{ __('Szerzők:') }}</span>
        <span>
            @foreach($post->authors as $author)
                <a href="{{ route('cms.author.show', $author->slug) }}" class="text-blue-600 hover:text-blue-800 hover:underline">{{ $author->name }}</a>@if(!$loop->last), @endif
            @endforeach
        </span>
    </div>
    @endif

    @if($post->postGroups->isNotEmpty())
    <div class="flex items-center gap-1.5">
        <span class="font-semibold text-gray-700">{{ __('Csoportok:') }}</span>
        <span>
            @foreach($post->postGroups as $group)
                <a href="{{ route('cms.post-group.show', $group->slug) }}" class="text-blue-600 hover:text-blue-800 hover:underline">{{ $group->name }}</a>@if(!$loop->last), @endif
            @endforeach
        </span>
    </div>
    @endif

    @if($post->relationLoaded('keywords') && $post->getRelation('keywords')->isNotEmpty())
    <div class="flex items-center gap-1.5">
        <span class="font-semibold text-gray-700">{{ __('Kulcsszavak:') }}</span>
        <span>
            @foreach($post->getRelation('keywords') as $keyword)
                <a href="{{ route('cms.tag.show', $keyword->slug) }}" class="text-blue-600 hover:text-blue-800 hover:underline">{{ $keyword->name }}</a>@if(!$loop->last), @endif
            @endforeach
        </span>
    </div>
    @endif
</div>
