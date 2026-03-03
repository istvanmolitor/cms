@extends('cms::layouts.base')

@section('body')
    @themeInclude('cms::layouts.partials.header')

    <main class="flex-grow">
        @yield('page')
    </main>

    @themeInclude('cms::layouts.partials.footer')
@endsection
