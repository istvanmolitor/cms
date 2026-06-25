@extends($layout)

@section('page-title')
    {{ $postGroup->name }}
@endsection

@section('content')
    @if($posts->isNotEmpty())
        <x-cms::post-list :posts="$posts" />

        <x-cms::pager :paginator="$posts" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Ebben a csoportban még nincsenek bejegyzések.') }}
        </p>
    @endif
@endsection
