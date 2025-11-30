{{-- Példa arra, hogyan használható az x-content-region komponens --}}

@extends('layouts.app')

@section('content')
    {{-- Header régió --}}
    <x-content-region name="header" />

    {{-- Main content --}}
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {{-- Main content régió --}}
                <x-content-region name="main-content" />
            </div>

            <div class="col-md-4">
                {{-- Sidebar régió --}}
                <x-content-region name="sidebar" />
            </div>
        </div>
    </div>

    {{-- Footer régió --}}
    <x-content-region name="footer" />
@endsection

