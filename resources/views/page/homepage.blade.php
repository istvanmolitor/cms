@extends($layout)

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6 lg:p-8">
        <div class="prose prose-lg max-w-none">
            <h1 class="text-3xl font-bold mb-4">Üdvözöljük a főoldalon!</h1>
            <p>Ez a CMS rendszer alapértelmezett főoldala.</p>
            <x-cms-content-region name="homepage" />
        </div>
    </div>
@endsection
