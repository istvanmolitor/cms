@extends($layout)

@section('page-title')
    {{ __('Bejegyzések') }}
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
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
    <x-theme::template view="cms::post.partials.list-sidebar" />
@endsection
