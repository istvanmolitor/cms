<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Molitor\Cms\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    public function __construct(
        private Page $page,
        private ContentRepositoryInterface $contentRepository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->page->all();
    }

    public function getById(int $id): Page|null
    {
        return $this->page->find($id);
    }

    public function getBySlug(string $slug): Page|null
    {
        return $this->page->where('slug', $slug)->first();
    }

    public function create(array $data): Page
    {
        if (!isset($data['content_id'])) {
            $data['content_id'] = $this->contentRepository->create()->id;
        }

        $page = $this->page->create($data);


        return $page;
    }

    public function update(Page $page, array $data): Page
    {


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

