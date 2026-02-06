<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentElement;

class ContentElementRepository implements ContentElementRepositoryInterface
{
    private array $cache = [];

    public function __construct(
        private ContentElement $contentElement
    ) {
    }

    public function getById(int $id): ?ContentElement
    {
        if(!array_key_exists($id, $this->cache)) {
            $this->cache[$id] = $this->contentElement->find($id);
        }
        return $this->cache[$id];
    }

    public function getByContentId(int $contentId): Collection
    {
        return $this->contentElement->where('content_id', $contentId)->get();
    }

    public function getByContent(Content $content): Collection
    {
        return $this->getByContentId($content->id);
    }

    public function create(Content $content, string $type, string $data): ContentElement
    {
        return $this->contentElement->create([
            'content_id' => $content->id,
            'type' => $type,
            'content' => $data,
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

    public function deleteByContent(Content $content): void
    {
        $this->contentElement->where('content_id', $content->id)->delete();
    }
}

