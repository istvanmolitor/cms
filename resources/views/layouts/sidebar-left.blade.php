@extends('cms::layouts.base')

@section('body')
    <div class="container mx-auto flex">
        <aside class="w-1/4 pr-4">
            @yield('sidebar')
        </aside>
        <main class="w-3/4">
            @yield('content')
        </main>
    </div>
@endsection

