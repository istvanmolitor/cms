@extends($layout)

@section('page-title')
    {{ __('Kulcsszó csoportok') }}
@endsection

@section('top')
    <x-theme::template view="cms::keyword.partials.groups-top" />
@endsection

@section('content')
    @if($keywordGroups->isNotEmpty())
        <x-cms::keyword-group-list :keyword-groups="$keywordGroups" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Még nincsenek kulcsszó csoportok.') }}
        </p>
    @endif
@endsection

@section('sidebar')
    <x-theme::template view="cms::keyword.partials.groups-sidebar" />
@endsection

@section('bottom')
    <x-theme::template view="cms::keyword.partials.groups-bottom" />
@endsection

@section('page-top')
    <x-theme::template view="cms::keyword.partials.groups-page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="cms::keyword.partials.groups-page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="cms::keyword.partials.groups-content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="cms::keyword.partials.groups-content-bottom" />
@endsection
