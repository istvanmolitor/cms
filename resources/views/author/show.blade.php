@extends($layout)

@section('content')
  <x-cms::author-profile :author="$author" />

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
    @includeIf('cms::author.partials.show-sidebar')
@endsection

@section('top')
    @includeIf('cms::author.partials.show-top')
@endsection

@section('bottom')
    @includeIf('cms::author.partials.show-bottom')
@endsection

@section('page-top')
    @includeIf('cms::author.partials.show-page-top')
@endsection

@section('page-bottom')
    @includeIf('cms::author.partials.show-page-bottom')
@endsection

@section('content-top')
    @includeIf('cms::author.partials.show-content-top')
@endsection

@section('content-bottom')
    @includeIf('cms::author.partials.show-content-bottom')
@endsection
