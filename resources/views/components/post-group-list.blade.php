<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($postGroups as $postGroup)
        <x-cms::post-group-card :post-group="$postGroup" />
    @endforeach
</div>
