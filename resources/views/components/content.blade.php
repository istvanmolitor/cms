@if($content && $content->contentElements)
    @foreach($content->contentElements as $element)
        <x-cms::content-element :element="$element" />
    @endforeach
@endif
