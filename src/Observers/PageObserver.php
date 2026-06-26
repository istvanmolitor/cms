<?php

declare(strict_types=1);

namespace Molitor\Cms\Observers;

use Molitor\Cms\Models\Page;
use Molitor\Keyword\Repositories\KeywordableRepositoryInterface;

class PageObserver
{
    public function __construct(private readonly KeywordableRepositoryInterface $keywordableRepository) {}

    public function created(Page $page): void
    {
        $this->keywordableRepository->updateByString($page, $page->getAttributes()['keywords'] ?? '');
    }

    public function updated(Page $page): void
    {
        $this->keywordableRepository->updateByString($page, $page->getAttributes()['keywords'] ?? '');
    }
}
