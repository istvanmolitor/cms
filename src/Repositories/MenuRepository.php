<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Menu;
use Molitor\Language\Models\Language;

class MenuRepository implements MenuRepositoryInterface
{
    public function __construct(
        private Menu $menu
    ) {}

    public function getById(int $id): ?Menu
    {
        return $this->menu->with('language')->find($id);
    }

    public function getByName(string $name, Language $language): ?Menu
    {
        return $this->menu
            ->where('name', $name)
            ->where('language_id', $language->id)
            ->first();
    }

    public function getAll(array $params = []): mixed
    {
        $query = $this->menu->with('language');

        if (isset($params['search']) && $params['search']) {
            $query->where('name', 'like', "%{$params['search']}%");
        }

        if (isset($params['sort']) && $params['sort']) {
            $direction = $params['direction'] ?? 'asc';
            $query->orderBy($params['sort'], $direction);
        } else {
            $query->orderBy('name', 'asc');
        }

        if (isset($params['paginate']) && $params['paginate']) {
            return $query->paginate((int) ($params['per_page'] ?? 10));
        }

        return $query->get();
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
