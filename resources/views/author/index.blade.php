@extends($layout)

@section('content')
  <div class="relative rounded-2xl overflow-hidden mb-8" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #2563eb22 100%);">
    <div class="absolute inset-0 opacity-10" style="background: url('https://picsum.photos/seed/authors-bg/1200/300') center/cover;"></div>
    <div class="relative px-8 py-10">
      <div class="flex items-center gap-3 mb-2">
        <div class="w-1 h-8 bg-blue-500 rounded-full"></div>
        <span class="text-blue-400 text-xs font-bold uppercase tracking-widest">Szerzők</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-black text-white leading-tight">Szerkesztőségünk</h1>
      <p class="text-slate-400 mt-2 text-sm max-w-lg">Ismerd meg újságíróinkat és szerkesztőinket, akik naponta hozzák a legfrissebb híreket.</p>
      <div class="flex items-center gap-4 mt-4 text-xs text-slate-500">
        <span class="flex items-center gap-1.5">
          <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
          {{ $authors->count() }} szerző
        </span>
      </div>
    </div>
  </div>

  @if($authors->isEmpty())
    <div class="text-center py-16 text-slate-400 bg-white rounded-2xl border border-slate-100">
      <p class="text-lg">Nincsenek szerzők.</p>
    </div>
  @else
    <x-cms::author-list :authors="$authors" />
  @endif
@endsection

@section('sidebar')
    <x-theme::template view="cms::author.partials.list-sidebar" />
@endsection

@section('top')
    <x-theme::template view="cms::author.partials.index-top" />
@endsection

@section('bottom')
    <x-theme::template view="cms::author.partials.index-bottom" />
@endsection

@section('page-top')
    <x-theme::template view="cms::author.partials.index-page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="cms::author.partials.index-page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="cms::author.partials.index-content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="cms::author.partials.index-content-bottom" />
@endsection
