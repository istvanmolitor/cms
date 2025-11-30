@if($content->contentElements)
    @foreach($content->contentElements as $element)
        <x-content-element :element="$element" />
    @endforeach
@endif
