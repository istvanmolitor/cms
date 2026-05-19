@extends($layout)

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-8">
            {{ __('Szerzők') }}
        </h1>

        @if($authors->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($authors as $author)
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('cms.author.show', $author->slug) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $author->name }}
                            </a>
                        </h2>
                        @if($author->profile_url)
                            <a href="{{ $author->profile_url }}" target="_blank" rel="noopener noreferrer" class="text-xs text-gray-500 hover:text-gray-700">
                                {{ __('Külső profil') }}
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $authors->links() }}
            </div>
        @else
            <p class="text-gray-500 italic">
                {{ __('Még nincsenek szerzők az oldalon.') }}
            </p>
        @endif
    </div>
@endsection
