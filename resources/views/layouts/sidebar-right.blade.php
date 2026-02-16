@extends('cms::layouts.page')

@section('page')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="w-full lg:w-3/4">
                @yield('content')
            </div>
            <aside class="w-full lg:w-1/4 bg-white rounded-lg shadow-sm p-6">
                <x-cms-content-region name="sidebar" />
            </aside>
        </div>
    </div>
@endsection

