<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Molitor\Cms\Models\ContentElement as ContentElementModel;
use Molitor\Cms\Services\ContentElementHandler;

class ContentElement extends Component
{
    public function __construct(
        private ContentElementHandler $contentElementHandler,
        public ContentElementModel $element,
    ) {

    }

    public function render(): View
    {
        $content = $this->contentElementHandler->render($this->element);

        return view('cms::components.content-element', [
            'element' => $this->element,
            'content' => $content
        ]);
    }
}

