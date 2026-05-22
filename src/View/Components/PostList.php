<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostList extends Component
{
    public function __construct(
        public mixed $posts,
    ) {}

    public function render(): View
    {
        return view('cms::components.post-list');
    }
}
