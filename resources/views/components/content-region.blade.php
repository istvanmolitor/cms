@if($isEditable)
<div style="position:relative;min-height:2em;">
    <div style="position:absolute;top:0;left:0;z-index:10;">
        <a href="/admin/cms/region/{{ $region->id }}/edit" style="display:inline-flex;align-items:center;gap:6px;padding:4px 10px;border:1px solid currentColor;border-radius:4px;text-decoration:none;font-size:0.8em;opacity:0.7;background:#fff;">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" /></svg>
            {{ $region->name }}
        </a>
    </div>
    <x-cms::content :content="$region->content" />
</div>
@else
<x-cms::content :content="$region->content" />
@endif
