<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\ContentBox;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentRegion;

class ContentBoxRepository implements ContentBoxRepositoryInterface
{
    public function __construct(
        private ContentBox $contentBox
    ) {
    }

    public function getById(int $id): ?ContentBox
    {
        return $this->contentBox->find($id);
    }

    public function getByContentRegionId(int $contentRegionId): Collection
    {
        return $this->contentBox
            ->where('content_region_id', $contentRegionId)
            ->orderBy('sort', 'asc')
            ->get();
    }

    public function getByContentRegion(ContentRegion $contentRegion): Collection
    {
        return $this->getByContentRegionId($contentRegion->id);
    }

    public function getByContentId(int $contentId): Collection
    {
        return $this->contentBox
            ->where('content_id', $contentId)
            ->orderBy('sort', 'asc')
            ->get();
    }

    public function getByContent(Content $content): Collection
    {
        return $this->getByContentId($content->id);
    }

    public function getVisibleByContentRegionId(int $contentRegionId): Collection
    {
        return $this->contentBox
            ->where('content_region_id', $contentRegionId)
            ->where('is_visible', true)
            ->orderBy('sort', 'asc')
            ->get();
    }

    public function getVisibleByContentRegion(ContentRegion $contentRegion): Collection
    {
        return $this->getVisibleByContentRegionId($contentRegion->id);
    }

    public function create(
        int $contentRegionId,
        int $contentId,
        string $title,
        bool $isVisible = true,
        int $sort = 0
    ): ContentBox {
        return $this->contentBox->create([
            'content_region_id' => $contentRegionId,
            'content_id' => $contentId,
            'title' => $title,
            'is_visible' => $isVisible,
            'sort' => $sort,
        ]);
    }

    public function update(
        ContentBox $contentBox,
        ?int $contentRegionId = null,
        ?int $contentId = null,
        ?string $title = null,
        ?bool $isVisible = null,
        ?int $sort = null
    ): ContentBox {
        $data = [];

        if ($contentRegionId !== null) {
            $data['content_region_id'] = $contentRegionId;
        }

        if ($contentId !== null) {
            $data['content_id'] = $contentId;
        }

        if ($title !== null) {
            $data['title'] = $title;
        }

        if ($isVisible !== null) {
            $data['is_visible'] = $isVisible;
        }

        if ($sort !== null) {
            $data['sort'] = $sort;
        }

        if (!empty($data)) {
            $contentBox->update($data);
        }

        return $contentBox->fresh();
    }

    public function delete(ContentBox $contentBox): void
    {
        $contentBox->delete();
    }

    public function getAll(): Collection
    {
        return $this->contentBox
            ->orderBy('content_region_id', 'asc')
            ->orderBy('sort', 'asc')
            ->get();
    }
}

