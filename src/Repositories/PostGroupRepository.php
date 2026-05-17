<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PostGroup;

class PostGroupRepository implements PostGroupRepositoryInterface
{
    public function __construct(
        private PostGroup $postGroup
    ) {}

    public function getAll(): Collection
    {
        return $this->postGroup->all();
    }

    public function getById(int $id): ?PostGroup
    {
        return $this->postGroup->find($id);
    }

    public function getBySlug(string $slug): ?PostGroup
    {
        return $this->postGroup->where('slug', $slug)->first();
    }

    public function create(array $data): PostGroup
    {
        return $this->postGroup->create($data);
    }

    public function update(PostGroup $postGroup, array $data): PostGroup
    {
        $postGroup->update($data);

        return $postGroup;
    }

    public function delete(PostGroup $postGroup): void
    {
        $postGroup->delete();
    }
}
