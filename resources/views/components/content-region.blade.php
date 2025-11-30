@if($contentBoxes && $contentBoxes->count() > 0)
    <div class="content-region" data-region="{{ $name }}">
        @foreach($contentBoxes as $contentBox)
            <div class="content-box" data-box-id="{{ $contentBox->id }}">
                @if($contentBox->title)
                    <h3 class="content-box-title">{{ $contentBox->title }}</h3>
                @endif

                @if($contentBox->content && $contentBox->content->contentElements)
                    @foreach($contentBox->content->contentElements->sortBy('id') as $element)
                        <div class="content-element content-element-{{ $element->type }}">
                            @if($element->type === 'html' || $element->type === 'text')
                                {!! $element->content !!}
                            @else
                                {{ $element->content }}
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
@endif
