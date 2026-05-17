<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PostGroup;

interface PostGroupRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?PostGroup;

    public function getBySlug(string $slug): ?PostGroup;

    public function create(array $data): PostGroup;

    public function update(PostGroup $postGroup, array $data): PostGroup;

    public function delete(PostGroup $postGroup): void;
}
