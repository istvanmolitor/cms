@extends('cms::layouts.base')

@section('body')
    @include('cms::layouts.partials.header')
    <div class="w-full">
        @yield('content')
    </div>
    @include('cms::layouts.partials.footer')
@endsection

