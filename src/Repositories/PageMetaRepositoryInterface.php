<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PageMeta;

interface PageMetaRepositoryInterface
{
    public function getAllForPage(int $pageId): Collection;

    public function getById(int $id): ?PageMeta;

    public function getByPageIdAndName(int $pageId, string $name): ?PageMeta;

    public function create(array $data): PageMeta;

    public function update(PageMeta $pageMeta, array $data): PageMeta;

    public function delete(PageMeta $pageMeta): void;
}

