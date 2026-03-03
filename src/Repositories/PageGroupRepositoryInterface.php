<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\PageGroup;

interface PageGroupRepositoryInterface
{
    public function getAll(): \Illuminate\Support\Collection;

    public function getById(int $id): ?PageGroup;
    public function getBySlug(string $slug): ?PageGroup;

    public function create(array $data): PageGroup;

    public function update(PageGroup $pageGroup, array $data): PageGroup;

    public function delete(PageGroup $pageGroup): void;
}

