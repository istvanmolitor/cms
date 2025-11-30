@extends($layout)

@section('content')
    <h1>{{ $page->title }}</h1>
    <x-content :content="$page->content" />
@endsection
