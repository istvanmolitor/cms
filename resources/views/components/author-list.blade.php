<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    @foreach($authors as $author)
        <x-cms::author-card :author="$author" />
    @endforeach
</div>
