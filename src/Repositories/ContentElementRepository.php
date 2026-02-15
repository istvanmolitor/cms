<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentElement;
use Molitor\Cms\Services\ContentHandler;

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
        return $this->contentElement->where('content_id', $contentId)->orderBy('sort', 'asc')->get();
    }

    public function getByContent(Content $content): Collection
    {
        return $this->getByContentId($content->id);
    }

    public function getCountByContent(Content $content): int
    {
        return $this->contentElement->where('content_id', $content->id)->count();
    }

    public function create(Content $content, int $contentElementTypeId, string $settings): ContentElement
    {
        return $this->contentElement->create([
            'content_id' => $content->id,
            'content_element_type_id' => $contentElementTypeId,
            'settings' => $settings,
            'sort' => $this->getCountByContent($content),
            'is_visible' => true,
        ]);
    }

    public function update(ContentElement $contentElement, int $contentElementTypeId, string $settings): ContentElement
    {
        $contentElement->update([
            'content_element_type_id' => $contentElementTypeId,
            'settings' => $settings,
        ]);

        return $contentElement->fresh();
    }

    public function delete(ContentElement $contentElement): void
    {
        $contentElement->delete();
    }

    public function deleteByContent(Content $content): void
    {
        $this->contentElement->where('content_id', $content->id)->delete();
    }

    public function deleteWhereSortGreaterOrEqual(Content $content, int $sort): void
    {
        $this->contentElement
            ->where('content_id', $content->id)
            ->where('sort', '>=', $sort)
            ->delete();
    }
}

