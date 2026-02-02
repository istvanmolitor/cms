<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\ContentRegion;

class ContentRegionRepository implements ContentRegionRepositoryInterface
{
    public function __construct(
        private ContentRegion $contentRegion,
        private ContentRepositoryInterface $contentRepository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->contentRegion->all();
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
            'content_id' => $this->contentRepository->create()->id,
        ]);
    }

    public function update(ContentRegion $contentRegion, array $data): ContentRegion
    {
        $contentRegion->update($data);

        return $contentRegion;
    }

    public function delete(ContentRegion $contentRegion): void
    {
        $contentRegion->delete();
    }
}

