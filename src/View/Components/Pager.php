<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pager extends Component
{
    public function __construct(
        public LengthAwarePaginator $paginator,
    ) {}

    public function render(): View
    {
        return view('cms::components.pager');
    }
}
