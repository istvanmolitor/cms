@extends('cms::layouts.page')

@section('page')
    <div class="container mx-auto flex">
        <main class="w-3/4">
            @yield('content')
        </main>
        <aside class="w-1/4 pr-4">
            <x-content-region name="sidebar" />
        </aside>
    </div>
@endsection

