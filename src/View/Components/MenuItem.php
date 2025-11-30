<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class MenuItem extends Component
{
    public function __construct(
        public \Molitor\Cms\Models\MenuItem $item
    ) {
    }

    public function render(): View
    {
        return view('cms::components.menu-item');
    }
}

