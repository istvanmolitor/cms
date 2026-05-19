<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\Post;
use Molitor\Cms\Models\PostMeta;

interface PostMetaRepositoryInterface
{
    public function getAllForPost(int $postId): Collection;

    public function getById(int $id): ?PostMeta;

    public function getByPostIdAndName(int $postId, string $name): ?PostMeta;

    public function getByValue(string $value, ?string $name = null): ?PostMeta;

    public function create(array $data): PostMeta;

    public function update(PostMeta $postMeta, array $data): PostMeta;

    public function delete(PostMeta $postMeta): void;

    public function exists(Post $post, string $name): bool;

    public function save(Post $post, string $name, string $value): PostMeta;
}
