@extends('cms::layouts.base')

@section('body')
    @include('cms::layouts.partials.header')
    <div class="container mx-auto">
        @yield('content')
    </div>
    @include('cms::layouts.partials.footer')
@endsection
