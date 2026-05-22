<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Author;

interface AuthorRepositoryInterface
{
    public function getAll(array $params = []): mixed;

    public function getById(int $id): ?Author;

    public function getBySlug(string $slug): ?Author;

    public function existsBySlug(string $slug): bool;

    public function generateUniqueSlug(string $name, string $fallback = 'author'): string;

    public function create(array $data): Author;

    public function update(Author $author, array $data): Author;

    public function delete(Author $author): void;
}
