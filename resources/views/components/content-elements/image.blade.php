@php
    $alignment = $settings['alignment'] ?? 'left';
    $alignmentClass = match($alignment) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
@endphp

<div class="content-element content-element-image {{ $alignmentClass }}">
    <img src="{{ $settings['src'] }}"
         alt="{{ $settings['alt'] ?? 'Content image' }}"
         @if(isset($settings['width']))
         width="{{ $settings['width'] }}"
         @endif
         @if(isset($settings['height']))
         height="{{ $settings['height'] }}"
         @endif
         class="inline-block"
         >
</div>

