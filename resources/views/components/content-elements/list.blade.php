@php
    $items = $settings['items'] ?? [];
@endphp

<div class="content-element content-element-list mb-6">
    @if(!empty($items))
        <ul class="list-disc pl-6 space-y-2 text-gray-700">
            @foreach($items as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    @endif
</div>
