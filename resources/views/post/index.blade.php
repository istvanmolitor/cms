@extends($layout)

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-8">
            {{ __('Bejegyzések') }}
        </h1>

        @if($posts->isNotEmpty())
            <x-cms-post-list :posts="$posts" />

            <x-cms-pager :paginator="$posts" />
        @else
            <p class="text-gray-500 italic">
                {{ __('Még nincsenek publikált bejegyzések.') }}
            </p>
        @endif
    </div>
@endsection

@section('sidebar')
    <x-theme::component view="cms::post.partials.list-sidebar" />
@endsection
