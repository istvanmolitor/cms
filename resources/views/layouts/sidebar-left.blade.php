@extends('cms::layouts.base')

@section('body')
    @include('cms::layouts.partials.header')
    <div class="container mx-auto flex">
        <aside class="w-1/4 pr-4">
            <x-content-region name="sidebar" />
        </aside>
        <main class="w-3/4">
            @yield('content')
        </main>
    </div>
    @include('cms::layouts.partials.footer')
@endsection

