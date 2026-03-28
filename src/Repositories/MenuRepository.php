<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Menu;

class MenuRepository implements MenuRepositoryInterface
{
    public function __construct(
        private Menu $menu
    ) {}

    public function getById(int $id): ?Menu
    {
        return $this->menu->with('language')->find($id);
    }

    public function getByName(string $name): ?Menu
    {
        return $this->menu->with('language')->where('name', $name)->first();
    }

    public function getAll(): Collection
    {
        return $this->menu->with('language')->get();
    }

    public function create(string $name, int $languageId): Menu
    {
        return $this->menu->create([
            'name' => $name,
            'language_id' => $languageId,
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
