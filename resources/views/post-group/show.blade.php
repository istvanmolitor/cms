@extends($layout)

@section('page-title')
    {{ $postGroup->name }}
@endsection

@section('top')
    @includeIf('cms::post-group.partials.show-top')
@endsection

@section('content')
    @if($posts->isNotEmpty())
        <x-cms::post-list :posts="$posts" />

        <x-cms::pager :paginator="$posts" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Ebben a csoportban még nincsenek bejegyzések.') }}
        </p>
    @endif
@endsection

@section('sidebar')
    @includeIf('cms::post-group.partials.show-sidebar')
@endsection

@section('bottom')
    @includeIf('cms::post-group.partials.show-bottom')
@endsection

@section('page-top')
    @includeIf('cms::post-group.partials.show-page-top')
@endsection

@section('page-bottom')
    @includeIf('cms::post-group.partials.show-page-bottom')
@endsection

@section('content-top')
    @includeIf('cms::post-group.partials.show-content-top')
@endsection

@section('content-bottom')
    @includeIf('cms::post-group.partials.show-content-bottom')
@endsection
