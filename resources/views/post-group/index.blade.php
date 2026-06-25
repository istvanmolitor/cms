@extends($layout)

@section('page-title')
    {{ __('Bejegyzés csoportok') }}
@endsection

@section('content')
    @if($postGroups->isNotEmpty())
        <x-cms::post-group-list :post-groups="$postGroups" />
    @else
        <p class="text-gray-500 italic">
            {{ __('Még nincsenek bejegyzés csoportok.') }}
        </p>
    @endif
@endsection
