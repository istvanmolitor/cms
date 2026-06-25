@extends($layout)

@section('page-title')
    {{ __('Bejegyzés csoportok') }}
@endsection

@section('top')
    <x-theme::template view="cms::post-group.partials.index-top" />
@endsection

@section('content')
    @if($postGroups->isNotEmpty())
        <x-cms::post-group-list :post-groups="$postGroups" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Még nincsenek bejegyzés csoportok.') }}
        </p>
    @endif
@endsection

@section('sidebar')
    <x-theme::template view="cms::post-group.partials.index-sidebar" />
@endsection

@section('bottom')
    <x-theme::template view="cms::post-group.partials.index-bottom" />
@endsection

@section('page-top')
    <x-theme::template view="cms::post-group.partials.index-page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="cms::post-group.partials.index-page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="cms::post-group.partials.index-content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="cms::post-group.partials.index-content-bottom" />
@endsection
