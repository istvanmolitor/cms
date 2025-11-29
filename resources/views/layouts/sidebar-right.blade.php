@extends('cms::layouts.base')

@section('body')
    <div class="container mx-auto flex">
        <main class="w-3/4 pr-4">
            @yield('content')
        </main>
        <aside class="w-1/4">
            @yield('sidebar')
        </aside>
    </div>
@endsection

