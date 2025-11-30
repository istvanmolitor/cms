@extends('cms::layouts.base')

@section('body')
    @include('cms::layouts.partials.header')

    <main class="flex-grow">
        @yield('page')
    </main>

    @include('cms::layouts.partials.footer')
@endsection
