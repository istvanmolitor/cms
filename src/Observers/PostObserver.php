<?php

declare(strict_types=1);

namespace Molitor\Cms\Observers;

use Molitor\Cms\Models\Post;
use Molitor\Keyword\Repositories\KeywordableRepositoryInterface;

class PostObserver
{
    public function __construct(private readonly KeywordableRepositoryInterface $keywordableRepository) {}

    public function created(Post $post): void
    {
        $this->keywordableRepository->updateByString($post, $post->getAttributes()['keywords'] ?? '');
    }

    public function updated(Post $post): void
    {
        $this->keywordableRepository->updateByString($post, $post->getAttributes()['keywords'] ?? '');
    }
}
