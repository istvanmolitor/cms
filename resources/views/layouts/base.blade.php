<!DOCTYPE html>
<html lang="hu" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $page->meta_description ?? '' }}">
    <title>{{ $page->title ?? config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full flex flex-col bg-gray-50 text-gray-900 antialiased">
    @yield('body')
</body>
</html>

