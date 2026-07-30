<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentElementWrapper extends Component
{
    public function __construct(
        public string $type,
    ) {}

    public function render(): View
    {
        return template('cms::components.content-element-wrapper', [
            'type' => $this->type,
        ]);
    }
}
