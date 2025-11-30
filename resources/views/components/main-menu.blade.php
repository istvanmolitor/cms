@if($menu && $menu->items->count() > 0)
    @foreach($menu->items as $item)
        <x-cms::menu-item :item="$item" />
    @endforeach
@endif
