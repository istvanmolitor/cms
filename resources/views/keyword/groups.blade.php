@extends($layout)

@section('page-title')
    {{ __('Kulcsszó csoportok') }}
@endsection

@section('top')
    @includeIf('cms::keyword.partials.groups-top')
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
    @includeIf('cms::keyword.partials.groups-sidebar')
@endsection

@section('bottom')
    @includeIf('cms::keyword.partials.groups-bottom')
@endsection

@section('page-top')
    @includeIf('cms::keyword.partials.groups-page-top')
@endsection

@section('page-bottom')
    @includeIf('cms::keyword.partials.groups-page-bottom')
@endsection

@section('content-top')
    @includeIf('cms::keyword.partials.groups-content-top')
@endsection

@section('content-bottom')
    @includeIf('cms::keyword.partials.groups-content-bottom')
@endsection
