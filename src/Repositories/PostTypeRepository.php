<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PostType;

class PostTypeRepository implements PostTypeRepositoryInterface
{
    public function __construct(
        private PostType $postType
    ) {}

    public function getAll(): Collection
    {
        return $this->postType->all();
    }

    public function getDefault(): ?PostType
    {
        return $this->postType->first();
    }

    public function getById(int $id): ?PostType
    {
        return $this->postType->find($id);
    }

    public function getBySlug(string $slug): ?PostType
    {
        return $this->postType->where('slug', $slug)->first();
    }

    public function create(array $data): PostType
    {
        return $this->postType->create($data);
    }

    public function update(PostType $postType, array $data): PostType
    {
        $postType->update($data);

        return $postType;
    }

    public function delete(PostType $postType): void
    {
        $postType->delete();
    }
}
