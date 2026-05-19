@extends($layout)

@section('content')
    <article class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
         <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
            {{ $post->title }}
        </h1>
        @if($post->main_image_url)
            <img
                src="{{ $post->main_image_url }}"
                alt="{{ $post->title }}"
                class="w-full h-auto rounded-lg mb-6 object-cover"
            >
        @endif


        @if($post->lead)
            <p class="mb-8 px-5 py-4 rounded-lg border-l-4 border-blue-500 bg-blue-50 text-lg lg:text-xl font-medium text-gray-900">
                {{ $post->lead }}
            </p>
        @endif

        <div class="prose prose-lg max-w-none">
            <x-cms-content :content="$post->content" />
        </div>
    </article>
@endsection
