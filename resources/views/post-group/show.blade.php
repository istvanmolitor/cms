@extends($layout)

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-8">
            {{ $postGroup->name }}
        </h1>

        @if($posts->isNotEmpty())
            <div class="space-y-6">
                @foreach($posts as $post)
                    <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0">
                        <h2 class="text-2xl font-semibold mb-2">
                            <a href="{{ route('cms.post.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h2>
                        @if($post->lead)
                            <p class="text-gray-600 line-clamp-3">
                                {{ $post->lead }}
                            </p>
                        @endif
                        <div class="mt-4">
                            <a href="{{ route('cms.post.show', $post->slug) }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ __('Olvasd tovább') }} &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

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
