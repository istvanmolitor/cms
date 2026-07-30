@extends($layout)

@section('page-title')
    {{ $postType->name }}
@endsection

@section('top')
    @includeIf('cms::post-type.partials.show-top')
@endsection

@section('content')
    @if($posts->isNotEmpty())
        <x-cms::post-list :posts="$posts" />

        <x-cms::pager :paginator="$posts" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Ehhez a tartalomtípushoz még nincsenek bejegyzések.') }}
        </p>
    @endif
@endsection

@section('sidebar')
    @includeIf('cms::post-type.partials.show-sidebar')
@endsection

@section('bottom')
    @includeIf('cms::post-type.partials.show-bottom')
@endsection

@section('page-top')
    @includeIf('cms::post-type.partials.show-page-top')
@endsection

@section('page-bottom')
    @includeIf('cms::post-type.partials.show-page-bottom')
@endsection

@section('content-top')
    @includeIf('cms::post-type.partials.show-content-top')
@endsection

@section('content-bottom')
    @includeIf('cms::post-type.partials.show-content-bottom')
@endsection
