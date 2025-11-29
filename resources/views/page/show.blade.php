<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }}</title>
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
    <h1>{{ $page->title }}</h1>

    @if($page->content && $page->content->contentElements)
        @foreach($page->content->contentElements->sortBy('id') as $element)
            <div class="content-element">
                <div class="content-element-type">{{ $element->type }}</div>
                <div class="content-element-content">
                    @if($element->type === 'html' || $element->type === 'text')
                        {!! $element->content !!}
                    @else
                        {{ $element->content }}
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <p>Ez az oldal még nem tartalmaz tartalmat.</p>
    @endif
</body>
</html>

