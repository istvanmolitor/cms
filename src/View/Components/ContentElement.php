<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Molitor\Cms\Models\ContentElement as ContentElementModel;
use Molitor\Cms\Services\ContentHandler;

class ContentElement extends Component
{
    public function __construct(
        private ContentHandler $contentHandler,
        public ContentElementModel $element,
    ) {}

    public function render(): View
    {
        $content = $this->contentHandler->renderElement($this->element);

        return template('cms::components.content-element', [
            'element' => $this->element,
            'content' => $content,
        ]);
    }
}
