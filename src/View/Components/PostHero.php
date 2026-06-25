<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Molitor\Cms\Models\Post;

class PostHero extends Component
{
    public function __construct(
        public Post $post,
    ) {}

    public function render(): View
    {
        return template('cms::components.post-hero', [
            'post' => $this->post,
        ]);
    }
}
