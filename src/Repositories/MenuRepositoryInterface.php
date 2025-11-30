<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

interface MenuRepositoryInterface
{
    public function getById(int $id): ?Menu;

    public function getByName(string $name): ?Menu;

    public function getAll(): Collection;

    public function create(string $name): Menu;

    public function update(Menu $menu, array $data): Menu;

    public function delete(Menu $menu): void;
}


