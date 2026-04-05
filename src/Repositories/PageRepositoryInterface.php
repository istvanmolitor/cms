<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Page;

interface PageRepositoryInterface
{
    public function getAll(): \Illuminate\Support\Collection;

    public function getById(int $id): ?Page;

    public function getBySlug(string $slug): ?Page;

    public function existsBySlug(string $slug): bool;

    public function generateUniqueSlug(string $title, string $fallback = 'page'): string;

    public function create(array $data): Page;

    public function update(Page $page, array $data): Page;

    public function delete(Page $page): void;
}
