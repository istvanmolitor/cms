<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Molitor\Cms\Repositories\ContentBoxRepositoryInterface;
use Molitor\Cms\Repositories\ContentRegionRepositoryInterface;

class ContentRegion extends Component
{
    public $contentBoxes;

    public function __construct(
        private ContentBoxRepositoryInterface $contentBoxRepository,
        private ContentRegionRepositoryInterface $contentRegionRepository,
        public string $name
    ) {

    }

    public function render(): View
    {
        $region = $this->contentRegionRepository->getByName($this->name);
        if(!$region) {
            $region = $this->contentRegionRepository->create($this->name);
        }

        $this->contentBoxes = $this->contentBoxRepository->getVisibleByContentRegion($region);

        if ($this->contentBoxes->isNotEmpty()) {
            $this->contentBoxes->load('content.contentElements');
        }

        return view('cms::components.content-region');
    }
}

