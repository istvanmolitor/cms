<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\Post;
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

    public function exists(Post $post, string $name): bool
    {
        return $this->postMeta->where('post_id', $post->id)->where('name', $name)->exists();
    }

    public function save(Post $post, string $name, string $value): PostMeta
    {
        if($this->exists($post, $name)) {
            $postMeta = $this->getByPostIdAndName($post->id, $name);
            if (empty($value)) {
                $this->delete($postMeta);
                return $postMeta;
            }
            else {
                return $this->update($postMeta, ['meta_data' => $value]);
            }
        }
        else {
            return $this->create([
                'post_id' => $post->id,
                'name' => $name,
                'meta_data' => $value,
            ]);
        }
    }
}
