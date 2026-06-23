@if($isEditable)
    <a href="/admin/cms/region/{{ $region->id }}/edit">Régió szerkesztése</a>
@endif


<x-cms-content :content="$region->content" />
