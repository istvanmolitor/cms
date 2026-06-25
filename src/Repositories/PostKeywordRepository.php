<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\Post;
use Molitor\Keyword\Services\KeywordService;

class PostKeywordRepository implements PostKeywordRepositoryInterface
{
    public function __construct(private readonly KeywordService $keywordService) {}

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

    public function updateByPost(Post $post): void
    {
        $ids = $this->keywordService->getIds($post->getAttributes()['keywords'] ?? '');
        $post->keywords()->sync($ids);
    }
}
