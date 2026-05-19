@extends($layout)

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-8">
            {{ __('Bejegyzés csoportok') }}
        </h1>

        @if($postGroups->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($postGroups as $group)
                    <div class="border border-gray-100 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <h2 class="text-xl font-semibold mb-3">
                            <a href="{{ route('cms.post-group.show', $group->slug) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                                {{ $group->name }}
                            </a>
                        </h2>
                        <div class="mt-auto">
                            <a href="{{ route('cms.post-group.show', $group->slug) }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ __('Megtekintés') }} &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 italic">
                {{ __('Még nincsenek bejegyzés csoportok.') }}
            </p>
        @endif
    </div>
@endsection
