@extends('cms::layouts.base')

@section('body')
    @include('cms::layouts.partials.header')
    @yield('page')
    @include('cms::layouts.partials.footer')
@endsection
