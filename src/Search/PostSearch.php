<?php

declare(strict_types=1);

namespace Molitor\Cms\Search;

use Molitor\Admin\Search\AdminSearch;
use Molitor\Admin\Search\AdminSearchResults;
use Molitor\Cms\Models\Post;

class PostSearch extends AdminSearch
{
    public function search(string $q, int $limit, AdminSearchResults $results): void
    {
        $this->filter(Post::query(), $q, ['title', 'slug', 'lead'])
            ->limit($limit)
            ->get()
            ->each(fn (Post $post) => $results->addResult(
                type: 'post',
                typeLabel: 'Post',
                id: $post->id,
                title: $post->title,
                subtitle: $post->slug,
                url: "/admin/cms/posts/{$post->id}",
            ));
    }
}
