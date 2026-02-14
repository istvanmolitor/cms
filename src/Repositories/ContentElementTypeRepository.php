<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\ContentElementType;

class ContentElementTypeRepository implements ContentElementTypeRepositoryInterface
{
    private array $nameCache = [];
    private array $idCache = [];

    public function __construct(
        private ContentElementType $contentElementType
    ) {
    }

    public function addCache(ContentElementType|null $elementType): void
    {
        $this->idCache[$elementType->id] = $elementType;
        $this->nameCache[$elementType->name] = $elementType;
    }

    public function getById(int $id): ?ContentElementType
    {
        if(!array_key_exists($id, $this->idCache)) {
            $this->addCache($this->contentElementType->find($id));
        }
        return $this->idCache[$id];
    }

    private function create(string $name): ContentElementType
    {
        return $this->contentElementType->create(['name' => $name]);
    }

    public function getByName(string $name): ?ContentElementType
    {
        if(!array_key_exists($name, $this->nameCache)) {
            $contentElementType = $this->contentElementType->where('name', $name)->first();
            if(!$contentElementType) {
                $contentElementType = $this->create($name);
            }
            $this->addCache($contentElementType);
        }
        return $this->nameCache[$name];
    }

    public function getAll(): Collection
    {
        return $this->contentElementType->all();
    }
}
