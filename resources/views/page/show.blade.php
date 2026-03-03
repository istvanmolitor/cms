@extends($layout)

@section('content')
    <article class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
            {{ $page->title }}
        </h1>

        <div class="prose prose-lg max-w-none">
            <x-cms-content :content="$page->content" />
        </div>
    </article>
@endsection
