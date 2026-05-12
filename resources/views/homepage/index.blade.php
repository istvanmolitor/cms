@extends($layout)

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <div class="prose prose-lg max-w-none">
            <x-cms-content-region name="homepage" />
        </div>
    </div>
@endsection
