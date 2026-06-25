<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($posts as $post)
        <x-cms::post-card :post="$post" />
    @endforeach
</div>
