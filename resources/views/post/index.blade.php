@extends($layout)

@section('page-title')
    {{ __('Bejegyzések') }}
@endsection

@section('top')
    @includeIf('cms::post.partials.index-top')
@endsection

@section('content')
    @if($posts->isNotEmpty())
        <x-cms::post-list :posts="$posts" />

        <x-cms::pager :paginator="$posts" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Még nincsenek publikált bejegyzések.') }}
        </p>
    @endif
@endsection

@section('sidebar')
    @includeIf('cms::post.partials.list-sidebar')
@endsection

@section('bottom')
    @includeIf('cms::post.partials.index-bottom')
@endsection

@section('page-top')
    @includeIf('cms::post.partials.index-page-top')
@endsection

@section('page-bottom')
    @includeIf('cms::post.partials.index-page-bottom')
@endsection

@section('content-top')
    @includeIf('cms::post.partials.index-content-top')
@endsection

@section('content-bottom')
    @includeIf('cms::post.partials.index-content-bottom')
@endsection
