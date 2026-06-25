@extends($layout)

@section('page-title')
    {{ $page->title }}
@endsection

@section('top')
    <x-theme::template view="cms::page.partials.show-top" />
@endsection

@section('content')
    <x-cms::content :content="$page->content" />
@endsection

@section('sidebar')
    <x-theme::template view="cms::page.partials.show-sidebar" />
@endsection

@section('bottom')
    <x-theme::template view="cms::page.partials.show-bottom" />
@endsection

@section('page-top')
    <x-theme::template view="cms::page.partials.show-page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="cms::page.partials.show-page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="cms::page.partials.show-content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="cms::page.partials.show-content-bottom" />
@endsection
