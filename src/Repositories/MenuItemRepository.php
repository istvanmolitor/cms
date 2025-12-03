<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Menu;
use Molitor\Cms\Models\MenuItem;
use Illuminate\Database\Eloquent\Collection;

class MenuItemRepository implements MenuItemRepositoryInterface
{
    public function __construct(
        private MenuItem $menuItem
    ) {
    }

    public function getById(int $id): ?MenuItem
    {
        return $this->menuItem->find($id);
    }

    public function getByMenuId(int $menuId): Collection
    {
        return $this->menuItem
            ->where('menu_id', $menuId)
            ->orderBy('sort')
            ->get();
    }

    public function getByParentId(?int $parentId): Collection
    {
        return $this->menuItem
            ->where('parent_id', $parentId)
            ->orderBy('sort')
            ->get();
    }

    public function create(array $data): MenuItem
    {
        return $this->menuItem->create($data);
    }

    public function update(MenuItem $menuItem, array $data): MenuItem
    {
        $menuItem->update($data);
        return $menuItem->fresh();
    }

    public function delete(MenuItem $menuItem): void
    {
        // Delete children first
        $menuItem->children()->delete();
        $menuItem->delete();
    }

    public function updateSort(MenuItem $menuItem, int $sort): MenuItem
    {
        $menuItem->update(['sort' => $sort]);
        return $menuItem->fresh();
    }

    public function getOptions(): array
    {
        return $this->menuItem->all()->pluck('label', 'id')->toArray();
    }
}

