@extends($layout)

@section('page-title')
    {{ $pageGroup->name }}
@endsection

@section('content')
    @if($pages->isNotEmpty())
        <x-cms::page-list :pages="$pages" />

        <x-cms::pager :paginator="$pages" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Ebben a csoportban még nincsenek oldalak.') }}
        </p>
    @endif
@endsection
