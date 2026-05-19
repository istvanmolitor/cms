@extends($layout)

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-8">
            {{ $postGroup->name }}
        </h1>

        @if($posts->isNotEmpty())
            <x-cms-post-list :posts="$posts" />

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-500 italic">
                {{ __('Ebben a csoportban még nincsenek bejegyzések.') }}
            </p>
        @endif
    </div>
@endsection
