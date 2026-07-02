@php
    $post = $calculated['post'] ?? null;
@endphp

@if($post)
    <x-cms::post-hero :post="$post" />
@endif
