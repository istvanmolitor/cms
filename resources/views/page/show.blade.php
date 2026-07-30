@extends($layout)

@section('page-title')
    {{ $page->title }}
@endsection

@section('top')
    @includeIf('cms::page.partials.show-top')
@endsection

@section('content')
    <x-cms::content :content="$page->content" />
@endsection

@section('sidebar')
    @includeIf('cms::page.partials.show-sidebar')
@endsection

@section('bottom')
    @includeIf('cms::page.partials.show-bottom')
@endsection

@section('page-top')
    @includeIf('cms::page.partials.show-page-top')
@endsection

@section('page-bottom')
    @includeIf('cms::page.partials.show-page-bottom')
@endsection

@section('content-top')
    @includeIf('cms::page.partials.show-content-top')
@endsection

@section('content-bottom')
    @includeIf('cms::page.partials.show-content-bottom')
@endsection
