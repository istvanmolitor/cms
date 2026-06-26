<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthorProfile extends Component
{
    public function __construct(
        public mixed $author,
    ) {}

    public function initials(): string
    {
        return collect(explode(' ', $this->author->name))
            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
            ->take(2)
            ->join('');
    }

    public function render(): View
    {
        return template('cms::components.author-profile');
    }
}
