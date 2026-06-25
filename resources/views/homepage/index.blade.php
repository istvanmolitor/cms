@extends($layout)

@section('content')
    <x-cms::content-region name="homepage" />
@endsection

@section('sidebar')
    <x-theme::template view="cms::homepage.partials.sidebar" />
@endsection

@section('top')
    <x-theme::template view="cms::homepage.partials.top" />
@endsection

@section('bottom')
    <x-theme::template view="cms::homepage.partials.bottom" />
@endsection

@section('page-top')
    <x-theme::template view="cms::homepage.partials.page-top" />
@endsection

@section('page-bottom')
    <x-theme::template view="cms::homepage.partials.page-bottom" />
@endsection

@section('content-top')
    <x-theme::template view="cms::homepage.partials.content-top" />
@endsection

@section('content-bottom')
    <x-theme::template view="cms::homepage.partials.content-bottom" />
@endsection
