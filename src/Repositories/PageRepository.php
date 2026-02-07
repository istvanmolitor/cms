<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
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

        if (isset($data['content']['content_elements'])) {
            $content = $page->content;
            if ($content) {
                /** @var ContentElementRepositoryInterface $elementRepository */
                $elementRepository = app(ContentElementRepositoryInterface::class);

                foreach ($data['content']['content_elements'] as $elementData) {
                    $elementRepository->create(
                        $content,
                        $elementData['type'],
                        $elementData['content'],
                        $elementData['sort'] ?? 0,
                        $elementData['is_visible'] ?? true
                    );
                }
            }
        }

        return $page;
    }

    public function update(Page $page, array $data): Page
    {
        if (isset($data['content']['content_elements'])) {
            $content = $page->content;
            if ($content) {
                /** @var ContentElementRepositoryInterface $elementRepository */
                $elementRepository = app(ContentElementRepositoryInterface::class);

                // Egyszerűség kedvéért töröljük a régieket és újakat hozunk létre
                $elementRepository->deleteByContent($content);

                foreach ($data['content']['content_elements'] as $elementData) {
                    $elementRepository->create(
                        $content,
                        $elementData['type'],
                        $elementData['content'],
                        $elementData['sort'] ?? 0,
                        $elementData['is_visible'] ?? true
                    );
                }
            }
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

