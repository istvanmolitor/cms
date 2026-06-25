@extends('theme::layouts.right-sidebar')

@section('content')
  {{-- Szerző profil --}}
  <div class="bg-gradient-to-br from-slate-50 to-white border border-slate-200 rounded-2xl p-6 sm:p-8 mb-8">
    <div class="flex gap-6 flex-col sm:flex-row">

      @if($author->profile_url)
        <img src="{{ $author->profile_url }}" alt="{{ $author->name }}"
             class="w-24 h-24 rounded-2xl object-cover flex-shrink-0">
      @else
        @php
          $initials = collect(explode(' ', $author->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('');
        @endphp
        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-700 flex items-center justify-center text-white text-3xl font-black flex-shrink-0">
          {{ $initials }}
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

        <div class="flex items-center gap-4 mt-3 text-xs text-slate-400">
          <span>{{ $posts->total() }} megjelent cikk</span>
          @if($author->email)
            <span>·</span>
            <a href="mailto:{{ $author->email }}" class="text-blue-600 hover:underline">{{ $author->email }}</a>
          @endif
        </div>
      </div>
    </div>
  </div>

  {{-- Cikkek --}}
  <h2 class="text-xl font-black text-slate-900 mb-4">
    Cikkei
    <span class="text-slate-400 font-normal text-base">({{ $posts->total() }})</span>
  </h2>

  @if($posts->isEmpty())
    <div class="text-center py-16 text-slate-400 bg-white rounded-2xl border border-slate-100">
      <p class="text-lg">Még nincsenek megjelent cikkek.</p>
    </div>
  @else
    <x-cms::post-list :posts="$posts" />
    <x-cms::pager :paginator="$posts" />
  @endif
@endsection

@section('sidebar')
    <x-theme::template view="cms::author.partials.show-sidebar" />
@endsection
