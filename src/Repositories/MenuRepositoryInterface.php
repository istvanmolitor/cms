<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Menu;

interface MenuRepositoryInterface
{
    public function getById(int $id): ?Menu;

    public function getByName(string $name): ?Menu;

    public function getAll(): Collection;

    public function create(string $name, int $languageId): Menu;

    public function update(Menu $menu, array $data): Menu;

    public function delete(Menu $menu): void;
}
