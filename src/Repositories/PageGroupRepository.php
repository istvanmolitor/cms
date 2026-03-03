<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PageGroup;

class PageGroupRepository implements PageGroupRepositoryInterface
{
    public function __construct(
        private PageGroup $pageGroup
    ) {
    }

    public function getAll(): Collection
    {
        return $this->pageGroup->all();
    }

    public function getById(int $id): PageGroup|null
    {
        return $this->pageGroup->find($id);
    }

    public function getBySlug(string $slug): PageGroup|null
    {
        return $this->pageGroup->where('slug', $slug)->first();
    }

    public function create(array $data): PageGroup
    {
        return $this->pageGroup->create($data);
    }

    public function update(PageGroup $pageGroup, array $data): PageGroup
    {
        $pageGroup->update($data);
        return $pageGroup;
    }

    public function delete(PageGroup $pageGroup): void
    {
        $pageGroup->delete();
    }
}

