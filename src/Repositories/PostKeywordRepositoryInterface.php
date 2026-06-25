<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\Post;

interface PostKeywordRepositoryInterface
{
    public function getByPost(Post $post): Collection;

    public function attach(Post $post, int $keywordId): void;

    public function detach(Post $post, int $keywordId): void;

    public function sync(Post $post, array $keywordIds): void;
}
