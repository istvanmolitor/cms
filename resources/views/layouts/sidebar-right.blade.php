@extends('cms::layouts.base')

@section('body')
    @include('cms::layouts.partials.header')
    <div class="container mx-auto flex">
        <main class="w-3/4 pr-4">
            @yield('content')
        </main>
        <aside class="w-1/4">
            @yield('sidebar')
        </aside>
    </div>
    @include('cms::layouts.partials.footer')
@endsection

