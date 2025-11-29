@extends($layout)

@section('content')
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
@endsection
