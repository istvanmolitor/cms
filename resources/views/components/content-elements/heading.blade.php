@php
    $text = $settings['text'] ?? '';
    $level = $settings['level'] ?? 2;
@endphp

<div class="content-element content-element-heading mb-6">
    @if($level == 1)
        <x-ui::typography.h1>{{ $text }}</x-ui::typography.h1>
    @elseif($level == 3)
        <x-ui::typography.h3>{{ $text }}</x-ui::typography.h3>
    @elseif($level == 4)
        <x-ui::typography.h4>{{ $text }}</x-ui::typography.h4>
    @elseif($level == 5)
        <x-ui::typography.h5>{{ $text }}</x-ui::typography.h5>
    @elseif($level == 6)
        <x-ui::typography.h6>{{ $text }}</x-ui::typography.h6>
    @else
        <x-ui::typography.h2>{{ $text }}</x-ui::typography.h2>
    @endif
</div>
