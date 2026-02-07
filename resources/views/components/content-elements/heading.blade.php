@php
    $text = is_array($content) ? ($content['text'] ?? '') : $content;
    $level = is_array($content) ? ($content['level'] ?? 2) : 2;
    $tagName = 'h' . $level;
    $class = match($level) {
        1 => 'text-3xl lg:text-4xl font-extrabold text-gray-900 mt-10 mb-6 first:mt-0',
        2 => 'text-2xl lg:text-3xl font-bold text-gray-900 mt-8 mb-4 first:mt-0',
        3 => 'text-xl lg:text-2xl font-semibold text-gray-900 mt-6 mb-3 first:mt-0',
        default => 'text-lg lg:text-xl font-medium text-gray-900 mt-4 mb-2 first:mt-0',
    };
@endphp

<div class="content-element content-element-heading mb-6">
    @if($level == 1)
        <h1 class="{{ $class }}">{!! $text !!}</h1>
    @elseif($level == 3)
        <h3 class="{{ $class }}">{!! $text !!}</h3>
    @elseif($level == 4)
        <h4 class="{{ $class }}">{!! $text !!}</h4>
    @elseif($level == 5)
        <h5 class="{{ $class }}">{!! $text !!}</h5>
    @elseif($level == 6)
        <h6 class="{{ $class }}">{!! $text !!}</h6>
    @else
        <h2 class="{{ $class }}">{!! $text !!}</h2>
    @endif
</div>
