@php
    $items = $settings['items'] ?? [];
@endphp

<x-cms::content-element-wrapper type="list" class="mb-6">
    @if(!empty($items))
        <x-ui::typography.list :items="$items" />
    @endif
</x-cms::content-element-wrapper>
