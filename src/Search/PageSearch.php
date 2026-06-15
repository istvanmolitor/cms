<?php

declare(strict_types=1);

namespace Molitor\Cms\Search;

use Molitor\Admin\Search\AdminSearch;
use Molitor\Admin\Search\AdminSearchResults;
use Molitor\Cms\Models\Page;

class PageSearch extends AdminSearch
{
    public function search(string $q, int $limit, AdminSearchResults $results): void
    {
        $this->filter(Page::query(), $q, ['title', 'slug', 'lead'])
            ->limit($limit)
            ->get()
            ->each(fn (Page $page) => $results->addResult(
                type: 'page',
                typeLabel: 'Oldal',
                id: $page->id,
                title: $page->title,
                subtitle: $page->slug,
                url: "/admin/cms/pages/{$page->id}",
            ));
    }
}
