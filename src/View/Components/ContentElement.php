<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Molitor\Cms\Models\ContentElement as ContentElementModel;

class ContentElement extends Component
{
    public function __construct(
        public ContentElementModel $element,
    ) {

    }

    public function render(): View
    {
        return view('cms::components.content-element', [
            'element' => $this->element,
        ]);
    }
}

