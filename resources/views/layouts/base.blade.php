<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }}</title>
    {{-- Betöltjük a Vite által buildelt Tailwind CSS-t, hogy a Tailwind osztályok érvényesüljenek a CMS nézetekben --}}
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .content-element {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .content-element-type {
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .content-element-content {
            color: #212529;
        }
    </style>
</head>
<body>
@yield('body')
</body>
</html>

