<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PageType;

class PageTypeRepository implements PageTypeRepositoryInterface
{
    public function __construct(
        private PageType $pageType
    ) {}

    public function getAll(): Collection
    {
        return $this->pageType->all();
    }

    public function getDefault(): ?PageType
    {
        return $this->pageType->first();
    }

    public function getById(int $id): ?PageType
    {
        return $this->pageType->find($id);
    }

    public function getBySlug(string $slug): ?PageType
    {
        return $this->pageType->where('slug', $slug)->first();
    }

    public function create(array $data): PageType
    {
        return $this->pageType->create($data);
    }

    public function update(PageType $pageType, array $data): PageType
    {
        $pageType->update($data);

        return $pageType;
    }

    public function delete(PageType $pageType): void
    {
        $pageType->delete();
    }
}
