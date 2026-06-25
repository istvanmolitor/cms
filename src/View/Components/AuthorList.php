<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthorList extends Component
{
    public function __construct(
        public mixed $authors,
    ) {}

    public function render(): View
    {
        return template('cms::components.author-list');
    }
}
