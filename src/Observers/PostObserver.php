<?php

declare(strict_types=1);

namespace Molitor\Cms\Observers;

use Molitor\Cms\Models\Post;
use Molitor\Cms\Repositories\PostKeywordRepositoryInterface;

class PostObserver
{
    public function __construct(private readonly PostKeywordRepositoryInterface $postKeywordRepository) {}

    public function created(Post $post): void
    {
        $this->postKeywordRepository->updateByPost($post);
    }

    public function updated(Post $post): void
    {
        $this->postKeywordRepository->updateByPost($post);
    }
}
