<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\ContentRegion;

class ContentRegionRepository implements ContentRegionRepositoryInterface
{
    public function __construct(
        private ContentRegion $contentRegion
    ) {
    }

    public function getById(int $id): ContentRegion|null
    {
        return $this->contentRegion->find($id);
    }

    public function getByName(string $name): ContentRegion|null
    {
        return $this->contentRegion->where('name', $name)->first();
    }

    public function create(string $name): ContentRegion
    {
        return $this->contentRegion->create([
            'name' => $name,
        ]);
    }

    public function delete(ContentRegion $contentRegion): void
    {
        $contentRegion->delete();
    }
}

