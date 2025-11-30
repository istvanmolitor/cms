@if($element)
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
@endif
