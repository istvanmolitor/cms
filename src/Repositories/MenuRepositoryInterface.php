<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Menu;
use Molitor\Language\Models\Language;

interface MenuRepositoryInterface
{
    public function getById(int $id): ?Menu;

    public function getByName(string $name, Language $language): ?Menu;

    public function getAll(array $params = []): mixed;

    public function create(string $name, int $languageId): Menu;

    public function update(Menu $menu, array $data): Menu;

    public function delete(Menu $menu): void;
}
