@php
    $text = $settings['text'] ?? '';
    $align = $settings['align'] ?? 'left';
    $alignClass = match($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        'justify' => 'text-justify',
        default => 'text-left',
    };
@endphp

<div class="content-element content-element-text mb-6">
    <p class="text-gray-700 leading-relaxed {{ $alignClass }}">
        {{ $text }}
    </p>
</div>

