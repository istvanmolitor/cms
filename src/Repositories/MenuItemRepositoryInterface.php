<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\MenuItem;

interface MenuItemRepositoryInterface
{
    public function getById(int $id): ?MenuItem;

    public function getByMenuId(int $menuId): Collection;

    public function getTreeByMenuId(int $menuId): Collection;

    public function getByParentId(?int $parentId): Collection;

    public function create(array $data): MenuItem;

    public function update(MenuItem $menuItem, array $data): MenuItem;

    public function delete(MenuItem $menuItem): void;

    public function updateSort(MenuItem $menuItem, int $sort): MenuItem;

    public function getOptions(): array;
}
