@extends($layout)

@section('content')

  {{-- Fejléc --}}
  <div class="relative rounded-2xl overflow-hidden mb-8" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #dc262622 100%);">
    <div class="relative px-8 py-10">
      <div class="flex items-center gap-3 mb-2">
        <div class="w-1 h-8 bg-red-500 rounded-full"></div>
        <span class="text-red-400 text-xs font-bold uppercase tracking-widest">Keresés</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-black text-white leading-tight mb-6">
        @if($query)
          „{{ $query }}"
        @else
          Keresés a hírportálon
        @endif
      </h1>

      {{-- Keresőmező --}}
      <form action="{{ route('cms.search') }}" method="GET" class="flex max-w-xl">
        <input
          type="text"
          name="q"
          value="{{ $query }}"
          placeholder="Írj be egy keresőkifejezést..."
          autofocus
          class="flex-1 border border-slate-600 bg-slate-800/80 text-white placeholder-slate-400 rounded-l-lg px-4 py-3 text-sm focus:outline-none focus:border-red-400"
        >
        <button type="submit" class="bg-red-600 text-white px-5 py-3 rounded-r-lg hover:bg-red-700 transition-colors" aria-label="Keresés">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </button>
      </form>

      @if($query)
        <p class="text-slate-400 mt-4 text-sm">
          {{ $posts->total() }} találat
        </p>
      @endif
    </div>
  </div>

  {{-- Eredmények --}}
  @if($query && $posts->isEmpty())
    <div class="text-center py-16 text-slate-400">
      <svg class="w-12 h-12 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
      </svg>
      <p class="text-lg font-semibold">Nincs találat</p>
      <p class="text-sm mt-1">Próbálj más keresőkifejezést!</p>
    </div>
  @elseif($posts->isNotEmpty())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
      @foreach($posts as $article)
        @include('news::partials.article.article-card')
      @endforeach
    </div>

    <div class="mt-4">
      {{ $posts->links('pagination::tailwind') }}
    </div>
  @endif

@endsection

@section('sidebar')
    <x-theme::template view="cms::search.partials.sidebar" />
@endsection
