<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\ContentElementType;

class ContentElementTypeRepository implements ContentElementTypeRepositoryInterface
{
    private array $cache = [];

    public function __construct(
        private ContentElementType $contentElementType
    ) {
    }

    public function getById(int $id): ?ContentElementType
    {
        if(!array_key_exists($id, $this->cache)) {
            $this->cache[$id] = $this->contentElementType->find($id);
        }
        return $this->cache[$id];
    }

    public function getByType(string $type): ?ContentElementType
    {
        return $this->contentElementType->where('name', $type)->first();
    }

    public function getAll(): Collection
    {
        return $this->contentElementType->all();
    }
}
