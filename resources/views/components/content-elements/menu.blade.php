@php
    $menuName = $settings['name'] ?? null;
    $menuItems = $menuName ? menu($menuName) : [];
@endphp

@if(!empty($menuItems))
    <nav class="content-element content-element-menu">
        <ul class="flex flex-col gap-1">
            @foreach($menuItems as $item)
                <li>
                    <a
                        href="{{ $item->getUrl() }}"
                        @if($item->isExternal()) target="_blank" rel="noopener noreferrer" @endif
                        class="hover:underline{{ $item->isActive() ? ' font-semibold' : '' }}"
                    >
                        {{ $item->getLabel() }}
                    </a>
                    @if(count($item->getMenuItems()) > 0)
                        <ul class="pl-4 mt-1 flex flex-col gap-1">
                            @foreach($item->getMenuItems() as $child)
                                <li>
                                    <a
                                        href="{{ $child->getUrl() }}"
                                        @if($child->isExternal()) target="_blank" rel="noopener noreferrer" @endif
                                        class="hover:underline{{ $child->isActive() ? ' font-semibold' : '' }}"
                                    >
                                        {{ $child->getLabel() }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
@endif
