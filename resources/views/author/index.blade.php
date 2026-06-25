@extends($layout)

@section('content')
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
