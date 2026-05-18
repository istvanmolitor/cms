<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PostMeta;

class PostMetaRepository implements PostMetaRepositoryInterface
{
    public function __construct(
        private PostMeta $postMeta
    ) {}

    public function getAllForPost(int $postId): Collection
    {
        return $this->postMeta->where('post_id', $postId)->get();
    }

    public function getById(int $id): ?PostMeta
    {
        return $this->postMeta->find($id);
    }

    public function getByPostIdAndName(int $postId, string $name): ?PostMeta
    {
        return $this->postMeta->where('post_id', $postId)->where('name', $name)->first();
    }

    public function getByValue(string $value, ?string $name = null): ?PostMeta
    {
        $query = $this->postMeta->where('meta_data', $value);

        if ($name !== null) {
            $query->where('name', $name);
        }

        return $query->first();
    }

    public function create(array $data): PostMeta
    {
        return $this->postMeta->create($data);
    }

    public function update(PostMeta $postMeta, array $data): PostMeta
    {
        $postMeta->update($data);

        return $postMeta;
    }

    public function delete(PostMeta $postMeta): void
    {
        $postMeta->delete();
    }
}
