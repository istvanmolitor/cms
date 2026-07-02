<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    public function __construct(
        public string $title,
        public ?string $imageSrc = null,
        public ?string $lead = null,
        public ?string $link = null,
        public ?string $linkText = null,
    ) {}

    public function render(): View
    {
        return template('cms::components.hero', [
            'title' => $this->title,
            'image_src' => $this->imageSrc,
            'lead' => $this->lead,
            'link' => $this->link,
            'linkText' => $this->linkText,
        ]);
    }
}
