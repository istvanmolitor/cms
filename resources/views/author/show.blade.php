@extends($layout)

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <div class="mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                {{ $author->name }}
            </h1>
            @if($author->profile_url)
                <a href="{{ $author->profile_url }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:text-blue-800 text-sm">
                    {{ __('Profil megtekintése') }} &rarr;
                </a>
            @endif
        </div>

        <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b">
            {{ __('Bejegyzések') }}
        </h2>

        @if($posts->isNotEmpty())
            <x-cms-post-list :posts="$posts" />

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-500 italic">
                {{ __('Ehhez a szerzőhöz még nincsenek bejegyzések.') }}
            </p>
        @endif
    </div>
@endsection
