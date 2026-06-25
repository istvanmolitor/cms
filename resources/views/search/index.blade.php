@extends($layout)

@section('page-title')
    @if($query)
        {{ __('Keresés: ":query"', ['query' => $query]) }}
    @else
        {{ __('Keresés') }}
    @endif
@endsection

@section('content')
    @if($query && $posts->isEmpty())
        <p class="text-gray-500 italic">
            {{ __('Nincs találat erre: ":query"', ['query' => $query]) }}
        </p>
    @elseif($posts->isNotEmpty())
        @if($query)
            <p class="text-sm text-gray-500 mb-4">
                {{ __(':total találat', ['total' => $posts->total()]) }}
            </p>
        @endif

        <x-cms::post-list :posts="$posts" />

        <x-cms::pager :paginator="$posts" />
    @endif
@endsection

@section('sidebar')
    <x-theme::template view="cms::search.partials.sidebar" />
@endsection
