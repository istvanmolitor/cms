<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Molitor\Menu\Services\MenuItem as MenuItemService;

class MenuItem extends Component
{
    public function __construct(
        public MenuItemService $item
    ) {
    }

    public function render(): View
    {
        return view('cms::components.menu-item');
    }
}

