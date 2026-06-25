@php
    $postId = $settings['post_id'] ?? null;
    $post = $postId ? \Molitor\Cms\Models\Post::with('authors')->find($postId) : null;
@endphp

@if($post)
    <x-cms::post-hero :post="$post" />
@endif
