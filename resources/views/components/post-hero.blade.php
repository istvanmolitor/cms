<x-cms::hero
    :title="$post->title"
    :image-src="$post->main_image_url"
    :lead="$post->lead"
    :link="$showLink ? route('cms.post.show', $post->slug) : null"
>
    <x-slot:meta>
        <span>{{ $post->created_at->format('Y.m.d.') }}</span>
        @if($post->relationLoaded('authors') && $post->authors->isNotEmpty())
            <span>&bull;</span>
            <span>{{ $post->authors->pluck('name')->implode(', ') }}</span>
        @endif
    </x-slot:meta>
</x-cms::hero>
