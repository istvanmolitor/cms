<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;
use Molitor\Cms\Repositories\ContentRegionRepositoryInterface;

class ContentRegion extends Component
{
    public bool $isEditable;

    public function __construct(
        private ContentRegionRepositoryInterface $contentRegionRepository,
        public string $name
    ) {
        $isEditable = Gate::allows('acl', 'cms_region');
        $this->isEditable = $isEditable;
    }

    public function render(): View
    {
        $region = $this->contentRegionRepository->getByName($this->name);

        if (! $region) {
            $region = $this->contentRegionRepository->create(['name' => $this->name]);
        }

        return template('cms::components.content-region', [
            'region' => $region,
        ]);
    }
}
