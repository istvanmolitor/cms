@if($menu && $menu->count() > 0)
    @foreach($menu->getMenuItems() as $item)
        <x-cms-menu-item :item="$item" />
    @endforeach
@endif
