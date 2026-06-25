<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($pages as $page)
        <x-cms::page-card :page="$page" />
    @endforeach
</div>
