<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($keywordGroups as $keywordGroup)
        <x-cms::keyword-group-card :keyword-group="$keywordGroup" />
    @endforeach
</div>
