<?php

declare(strict_types=1);

namespace Molitor\Cms\Services;

use Illuminate\Support\Collection;

class LayoutService
{
    /**
     * Get all available layouts.
     *
     * @return Collection
     */
    public function getLayouts(): Collection
    {
        return collect(config('cms.layouts', []));
    }

    /**
     * Get the template for a specific layout.
     *
     * @param string|null $layoutKey
     * @return string
     */
    public function getLayoutTemplate(?string $layoutKey): string
    {
        if (!$layoutKey) {
            $layoutKey = config('cms.default_layout', 'default');
        }

        return config("cms.layouts.{$layoutKey}.template", 'cms::layouts.default');
    }
}
