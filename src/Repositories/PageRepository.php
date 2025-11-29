<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function __construct(
        private Page $page
    ) {
    }

    public function getById(int $id): ?Page
    {
        return $this->page->find($id);
    }

    public function getBySlug(string $slug): ?Page
    {
        return $this->page->where('slug', $slug)->first();
    }

    public function getByContentId(int $contentId): ?Page
    {
        return $this->page->where('content_id', $contentId)->first();
    }

    public function getByContent(Content $content): ?Page
    {
        return $this->getByContentId($content->id);
    }

    public function create(string $title, string $slug, int $contentId): Page
    {
        return $this->page->create([
            'title' => $title,
            'slug' => $slug,
            'content_id' => $contentId,
        ]);
    }

    public function update(Page $page, array $data): Page
    {
        $page->update($data);
        return $page->fresh();
    }

    public function delete(Page $page): void
    {
        $page->delete();
    }

    public function getAll(): Collection
    {
        return $this->page->orderBy('created_at', 'desc')->get();
    }

    public function getAllByTitle(): Collection
    {
        return $this->page->orderBy('title')->get();
    }
}

