@extends($layout)

@section('title')
{{ $post->title }}
@endsection

@section('top')
@includeIf('cms::post.partials.show-top')
<x-cms::post-hero :post="$post" :show-link="false" />
@endsection

@section('content')
<article>
    <x-cms::post-info :post="$post" />
    <x-cms::content :content="$post->content" />
</article>
@endsection

@section('sidebar')
    @includeIf('cms::post.partials.show-sidebar')
@endsection

@section('bottom')
    @includeIf('cms::post.partials.show-bottom')
@endsection

@section('page-top')
    @includeIf('cms::post.partials.show-page-top')
@endsection

@section('page-bottom')
    @includeIf('cms::post.partials.show-page-bottom')
@endsection

@section('content-top')
    @includeIf('cms::post.partials.show-content-top')
@endsection

@section('content-bottom')
    @includeIf('cms::post.partials.show-content-bottom')
@endsection
