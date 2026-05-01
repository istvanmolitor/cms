<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Molitor\Cms\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function __construct(
        private Page $page,
        private ContentRepositoryInterface $contentRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->page->all();
    }

    public function getById(int $id): ?Page
    {
        return $this->page->find($id);
    }

    public function getBySlug(string $slug): ?Page
    {
        return $this->page->where('slug', $slug)->first();
    }

    public function existsBySlug(string $slug): bool
    {
        return $this->page->where('slug', $slug)->exists();
    }

    public function generateUniqueSlug(string $title, string $fallback = 'page'): string
    {
        $baseSlug = Str::slug($title);
        $baseSlug = $baseSlug !== '' ? $baseSlug : $fallback;

        $slug = $baseSlug;
        $counter = 1;

        while ($this->existsBySlug($slug)) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    public function create(
        string $title,
        string $slug,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null,
    ): Page {
        $data = [
            'title' => $title,
            'slug' => $slug,
            'content_id' => $this->contentRepository->create()->id,
        ];

        if ($isPublished !== null) {
            $data['is_published'] = $isPublished;
        }

        if ($lead !== null) {
            $data['lead'] = $lead;
        }

        if ($layout !== null) {
            $data['layout'] = $layout;
        }

        if ($mainImageUrl !== null) {
            $data['main_image_url'] = $mainImageUrl;
        }

        if ($languageId !== null) {
            $data['language_id'] = $languageId;
        }

        $page = $this->page->create($data);

        return $page;
    }

    public function update(
        Page $page,
        ?string $title = null,
        ?string $slug = null,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null
    ): Page {
        $data = [];

        if ($title !== null) {
            $data['title'] = $title;
        }

        if ($slug !== null) {
            $data['slug'] = $slug;
        }

        if ($isPublished !== null) {
            $data['is_published'] = $isPublished;
        }

        if ($lead !== null) {
            $data['lead'] = $lead;
        }

        if ($layout !== null) {
            $data['layout'] = $layout;
        }

        if ($mainImageUrl !== null) {
            $data['main_image_url'] = $mainImageUrl;
        }

        if ($languageId !== null) {
            $data['language_id'] = $languageId;
        }

        $page->update($data);

        return $page;
    }

    public function delete(Page $page): void
    {
        $content = $page->content;
        $page->delete();
        if ($content) {
            $this->contentRepository->delete($content);
        }
    }
}
