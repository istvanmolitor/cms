<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PageMeta;

class PageMetaRepository implements PageMetaRepositoryInterface
{
    public function __construct(
        private PageMeta $pageMeta
    ) {}

    public function getAllForPage(int $pageId): Collection
    {
        return $this->pageMeta->where('page_id', $pageId)->get();
    }

    public function getById(int $id): ?PageMeta
    {
        return $this->pageMeta->find($id);
    }

    public function getByPageIdAndName(int $pageId, string $name): ?PageMeta
    {
        return $this->pageMeta->where('page_id', $pageId)->where('name', $name)->first();
    }

    public function create(array $data): PageMeta
    {
        return $this->pageMeta->create($data);
    }

    public function update(PageMeta $pageMeta, array $data): PageMeta
    {
        $pageMeta->update($data);

        return $pageMeta;
    }

    public function delete(PageMeta $pageMeta): void
    {
        $pageMeta->delete();
    }
}
