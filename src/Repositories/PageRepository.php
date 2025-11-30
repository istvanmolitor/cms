<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function __construct(
        private Page $page,
        private ContentRepositoryInterface $contentRepository
    ) {
    }

    public function getById(int $id): Page|null
    {
        return $this->page->find($id);
    }

    public function getBySlug(string $slug): Page|null
    {
        return $this->page->where('slug', $slug)->first();
    }

    public function create(string $title, string $slug): Page
    {
        return $this->page->create([
            'title' => $title,
            'slug' => $slug,
            'content_id' => $this->contentRepository->create()->id,
        ]);
    }

    public function delete(Page $page): void
    {
        $content = $page->content;
        $page->delete();
        $this->contentRepository->delete($content);
    }
}

