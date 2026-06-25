@extends($layout)

@section('page-title')
    {{ __('Bejegyzések') }}
@endsection

@section('top')
    <x-theme::template view="cms::post.partials.index-top" />
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
    <x-theme::template view="cms::post.partials.list-sidebar" />
@endsection

@section('bottom')
    <x-theme::template view="cms::post.partials.index-bottom" />
@endsection

@section('page-top')
    <x-theme::template view="cms::post.partials.index-page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="cms::post.partials.index-page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="cms::post.partials.index-content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="cms::post.partials.index-content-bottom" />
@endsection
