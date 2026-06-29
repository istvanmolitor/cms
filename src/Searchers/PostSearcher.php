<?php

declare(strict_types=1);

namespace Molitor\Cms\Searchers;

use Illuminate\Database\Eloquent\Builder;
use Molitor\Cms\Models\Post;
use Molitor\Search\Searchers\LikeSearcher;

class PostSearcher extends LikeSearcher
{
    protected function getModelClass(): string
    {
        return Post::class;
    }

    protected function getColumns(): array
    {
        return ['title', 'lead', 'slug'];
    }

    protected function getBaseQuery(): Builder
    {
        return Post::query()
            ->where('is_published', true)
            ->orderBy('created_at', 'desc');
    }
}
