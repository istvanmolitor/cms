<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Molitor\Cms\Models\Content as ContentModel;

class Content extends Component
{
    public function __construct(
        public ContentModel $content,
    ) {}

    public function render(): View
    {
        return template('cms::components.content', [
            'content' => $this->content,
        ]);
    }
}
