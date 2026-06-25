@if($calculated['posts']->isNotEmpty())
    <x-cms::post-list :posts="$calculated['posts']" />
@endif
