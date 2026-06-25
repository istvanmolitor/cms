@extends($layout)

@section('page-title')
    {{ $page->title }}
@endsection

@section('content')
    <x-cms::content :content="$page->content" />
@endsection
