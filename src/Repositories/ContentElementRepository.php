<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentElement;

class ContentElementRepository implements ContentElementRepositoryInterface
{
    public function __construct(
        private ContentElement $contentElement
    ) {
    }

    public function getById(int $id): ?ContentElement
    {
        return $this->contentElement->find($id);
    }

    public function getByContentId(int $contentId): Collection
    {
        return $this->contentElement->where('content_id', $contentId)->get();
    }

    public function getByContent(Content $content): Collection
    {
        return $this->getByContentId($content->id);
    }

    public function create(int $contentId, string $type, string $content): ContentElement
    {
        return $this->contentElement->create([
            'content_id' => $contentId,
            'type' => $type,
            'content' => $content,
        ]);
    }

    public function update(ContentElement $contentElement, array $data): ContentElement
    {
        $contentElement->update($data);
        return $contentElement->fresh();
    }

    public function delete(ContentElement $contentElement): void
    {
        $contentElement->delete();
    }

    public function getByType(string $type): Collection
    {
        return $this->contentElement->where('type', $type)->get();
    }
}

