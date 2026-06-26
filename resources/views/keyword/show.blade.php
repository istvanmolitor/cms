@extends($layout)

@section('page-title')
    {{ $keyword->name }}
@endsection

@section('top')
    <x-theme::template view="cms::keyword.partials.show-top" />
@endsection

@section('content')
    @if($posts->isNotEmpty())
        <x-cms::post-list :posts="$posts" />

        <x-cms::pager :paginator="$posts" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Ehhez a kulcsszóhoz még nincsenek bejegyzések.') }}
        </p>
    @endif
@endsection

@section('sidebar')
    <x-theme::template view="cms::keyword.partials.show-sidebar" />
@endsection

@section('bottom')
    <x-theme::template view="cms::keyword.partials.show-bottom" />
@endsection

@section('page-top')
    <x-theme::template view="cms::keyword.partials.show-page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="cms::keyword.partials.show-page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="cms::keyword.partials.show-content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="cms::keyword.partials.show-content-bottom" />
@endsection
