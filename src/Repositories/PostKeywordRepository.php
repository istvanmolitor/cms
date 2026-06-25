<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\Post;

class PostKeywordRepository implements PostKeywordRepositoryInterface
{
    public function getByPost(Post $post): Collection
    {
        return $post->keywords;
    }

    public function attach(Post $post, int $keywordId): void
    {
        $post->keywords()->attach($keywordId);
    }

    public function detach(Post $post, int $keywordId): void
    {
        $post->keywords()->detach($keywordId);
    }

    public function sync(Post $post, array $keywordIds): void
    {
        $post->keywords()->sync($keywordIds);
    }
}
