@extends($layout)

@section('content')
    <article class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <div class="prose prose-lg max-w-none">
            <x-content-region name="index" />
        </div>
    </article>
@endsection
