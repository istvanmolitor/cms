<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthorCard extends Component
{
    public function __construct(
        public mixed $author,
    ) {}

    public function render(): View
    {
        return template('cms::components.author-card');
    }
}
