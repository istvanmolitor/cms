<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;
use Molitor\Cms\Repositories\ContentRegionRepositoryInterface;

class ContentRegion extends Component
{
    public function __construct(
        private ContentRegionRepositoryInterface $contentRegionRepository,
        public string $name
    ) {}

    public function render(): View
    {
        $region = $this->contentRegionRepository->getByName($this->name);

        if (! $region) {
            $region = $this->contentRegionRepository->create(['name' => $this->name]);
        }

        return view('cms::components.content-region', [
            'isEditable' => Gate::allows('acl', 'cms'),
            'region' => $region,
        ]);
    }
}
