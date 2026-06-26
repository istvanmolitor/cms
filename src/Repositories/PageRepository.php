<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Str;
use Molitor\Cms\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function __construct(
        private Page $page,
        private ContentRepositoryInterface $contentRepository
    ) {}

    public function getAll(array $params = []): mixed
    {
        $query = $this->page->query();

        if (isset($params['search']) && $params['search']) {
            $query->where(function ($q) use ($params) {
                $q->where('title', 'like', "%{$params['search']}%")
                    ->orWhere('lead', 'like', "%{$params['search']}%");
            });
        }

        if (isset($params['sort']) && $params['sort']) {
            $direction = $params['direction'] ?? 'asc';
            $query->orderBy($params['sort'], $direction);
        } else {
            $query->orderBy('title', 'asc');
        }

        if (isset($params['paginate']) && $params['paginate']) {
            return $query->paginate((int) ($params['per_page'] ?? 10));
        }

        return $query->get();
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
        ?string $keywords = null,
        ?int $languageId = null,
        ?int $pageTypeId = null,
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

        $data['keywords'] = $keywords;

        if ($languageId !== null) {
            $data['language_id'] = $languageId;
        }

        $data['page_type_id'] = $pageTypeId;

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
        ?string $keywords = null,
        ?int $languageId = null,
        ?int $pageTypeId = null
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

        $data['keywords'] = $keywords;

        if ($languageId !== null) {
            $data['language_id'] = $languageId;
        }

        $data['page_type_id'] = $pageTypeId;

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
