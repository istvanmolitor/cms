<a href="{{ route('cms.author.show', $author->slug) }}"
   class="group bg-white rounded-2xl border border-slate-100 p-5 hover:shadow-lg hover:border-slate-200 transition-all duration-300 flex gap-4">

    @if($author->profile_url)
        <img src="{{ $author->profile_url }}" alt="{{ $author->name }}"
             class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
    @else
        @php
            $initials = collect(explode(' ', $author->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('');
        @endphp
        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-700 flex items-center justify-center text-white text-xl font-black flex-shrink-0">
            {{ $initials }}
        </div>
    @endif

    <div class="flex-1 min-w-0">
        <h3 class="font-black text-slate-900 group-hover:text-red-600 transition-colors truncate">{{ $author->name }}</h3>
        @if($author->position)
            <p class="text-slate-500 text-sm truncate">{{ $author->position }}</p>
        @endif
        @if($author->bio)
            <p class="text-slate-400 text-xs mt-1 leading-relaxed"
               style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                {{ $author->bio }}
            </p>
        @endif
        <div class="flex items-center gap-2 mt-2 text-xs text-slate-400">
            <span>{{ $author->posts_count }} megjelent cikk</span>
            <span class="ml-auto text-slate-300 group-hover:text-red-400 transition-colors">→</span>
        </div>
    </div>
</a>
