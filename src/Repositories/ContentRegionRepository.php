<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\ContentRegion;

class ContentRegionRepository implements ContentRegionRepositoryInterface
{
    public function __construct(
        private ContentRegion $contentRegion
    ) {
    }

    public function getById(int $id): ?ContentRegion
    {
        return $this->contentRegion->find($id);
    }

    public function getByName(string $name): ?ContentRegion
    {
        return $this->contentRegion->where('name', $name)->first();
    }

    public function create(string $name): ContentRegion
    {
        return $this->contentRegion->create([
            'name' => $name,
        ]);
    }

    public function update(ContentRegion $contentRegion, string $name): ContentRegion
    {
        $contentRegion->update([
            'name' => $name,
        ]);

        return $contentRegion->fresh();
    }

    public function delete(ContentRegion $contentRegion): void
    {
        $contentRegion->delete();
    }

    public function getAll(): Collection
    {
        return $this->contentRegion->orderBy('name', 'asc')->get();
    }
}

