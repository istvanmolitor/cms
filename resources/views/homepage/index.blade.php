@extends($layout)

@section('content')
    <x-cms::content-region name="homepage" />
@endsection

@section('sidebar')
    @includeIf('cms::homepage.partials.sidebar')
@endsection

@section('top')
    @includeIf('cms::homepage.partials.top')
@endsection

@section('bottom')
    @includeIf('cms::homepage.partials.bottom')
@endsection

@section('page-top')
    @includeIf('cms::homepage.partials.page-top')
@endsection

@section('page-bottom')
    @includeIf('cms::homepage.partials.page-bottom')
@endsection

@section('content-top')
    @includeIf('cms::homepage.partials.content-top')
@endsection

@section('content-bottom')
    @includeIf('cms::homepage.partials.content-bottom')
@endsection
