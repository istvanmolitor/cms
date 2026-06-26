@props(['author'])

<div class="bg-gradient-to-br from-slate-50 to-white border border-slate-200 rounded-2xl p-6 sm:p-8 mb-8">
    <div class="flex gap-6 flex-col sm:flex-row">

        @if($author->profile_url)
            <img src="{{ $author->profile_url }}" alt="{{ $author->name }}"
                 class="w-24 h-24 rounded-2xl object-cover flex-shrink-0">
        @else
            <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-700 flex items-center justify-center text-white text-3xl font-black flex-shrink-0">
                {{ $initials() }}
            </div>
        @endif

        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-3 flex-wrap">
                <div>
                    <h1 class="text-2xl font-black text-slate-900">{{ $author->name }}</h1>
                    @if($author->nickname)
                        <p class="text-slate-400 text-sm">{{ $author->nickname }}</p>
                    @endif
                    @if($author->position)
                        <p class="text-slate-500 text-sm mt-0.5">{{ $author->position }}</p>
                    @endif
                </div>
                <a href="{{ route('cms.author.index') }}"
                   class="text-xs text-slate-400 hover:text-slate-600 transition-colors flex-shrink-0">
                    ← Összes szerző
                </a>
            </div>

            @if($author->bio)
                <p class="text-slate-600 text-sm leading-relaxed mt-3">{{ $author->bio }}</p>
            @endif

            @if($author->email)
                <div class="flex items-center gap-4 mt-3 text-xs text-slate-400">
                    <a href="mailto:{{ $author->email }}" class="text-blue-600 hover:underline">{{ $author->email }}</a>
                </div>
            @endif
        </div>
    </div>
</div>
