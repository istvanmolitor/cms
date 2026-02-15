<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Molitor\Cms\Models\Page;
use Molitor\Cms\Services\ContentHandler;

class PageRepository implements PageRepositoryInterface
{
    public function __construct(
        private Page $page,
        private ContentRepositoryInterface $contentRepository,
        private ContentHandler $contentHandler
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
            $content = $this->contentRepository->getById($data['content_id']);
            if ($content) {
                /** @var ContentElementRepositoryInterface $elementRepository */
                $elementRepository = app(ContentElementRepositoryInterface::class);

                foreach ($data['content']['content_elements'] as $elementData) {
                    $elementRepository->create(
                        $content,
                        $elementData['type'],
                        $elementData['content'],
                    );
                }
            }
        }

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

    public function approveDraft(Page $page): void
    {
        if (!$page->draft_content_id) {
            return;
        }

        $draftContent = $page->draftContent;
        $publishedContent = $page->content;

        if (!$draftContent || !$publishedContent) {
            return;
        }

        $this->contentHandler->copyContentElements($draftContent, $publishedContent);
    }
}

