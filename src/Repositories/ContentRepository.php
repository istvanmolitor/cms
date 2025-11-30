<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Content;

class ContentRepository implements ContentRepositoryInterface
{
    public function __construct(
        private Content $content,
        private ContentElementRepositoryInterface $contentElementRepository
    ) {
    }

    public function getById(int $id): ?Content
    {
        return $this->content->find($id);
    }

    public function create(): Content
    {
        return $this->content->create();
    }

    public function delete(Content $content): void
    {
        $this->contentElementRepository->deleteByContent($content);
        $content->delete();
    }
}
