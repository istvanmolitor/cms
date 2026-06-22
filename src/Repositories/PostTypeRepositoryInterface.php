<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PostType;

interface PostTypeRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?PostType;

    public function getBySlug(string $slug): ?PostType;

    public function create(array $data): PostType;

    public function update(PostType $postType, array $data): PostType;

    public function delete(PostType $postType): void;
}
