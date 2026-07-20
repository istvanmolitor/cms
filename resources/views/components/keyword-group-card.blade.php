<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
    <h3 class="text-xl font-semibold mb-2 text-gray-800">
        {{ $keywordGroup->name }}
    </h3>
    @if($keywordGroup->keywords->isNotEmpty())
        <div class="flex flex-wrap gap-2">
            @foreach($keywordGroup->keywords as $keyword)
                <a href="{{ route('cms.tag.show', $keyword->slug) }}" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                    {{ $keyword->name }}
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic text-sm">
            {{ __('Ehhez a csoporthoz még nincsenek kulcsszavak.') }}
        </p>
    @endif
</div>
