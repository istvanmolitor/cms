<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuRepository implements MenuRepositoryInterface
{
    public function __construct(
        private Menu $menu
    ) {
    }

    public function getById(int $id): ?Menu
    {
        return $this->menu->find($id);
    }

    public function getByName(string $name): ?Menu
    {
        return $this->menu->where('name', $name)->first();
    }

    public function getAll(): Collection
    {
        return $this->menu->all();
    }

    public function create(string $name): Menu
    {
        return $this->menu->create([
            'name' => $name,
        ]);
    }

    public function update(Menu $menu, array $data): Menu
    {
        $menu->update($data);
        return $menu->fresh();
    }

    public function delete(Menu $menu): void
    {
        $menu->items()->delete();
        $menu->delete();
    }
}

