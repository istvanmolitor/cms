<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\ContentBox;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentRegion;

interface ContentBoxRepositoryInterface
{
    public function getById(int $id): ?ContentBox;

    public function getByContentRegionId(int $contentRegionId): Collection;

    public function getByContentRegion(ContentRegion $contentRegion): Collection;

    public function getByContentId(int $contentId): Collection;

    public function getByContent(Content $content): Collection;

    public function getVisibleByContentRegionId(int $contentRegionId): Collection;

    public function getVisibleByContentRegion(ContentRegion $contentRegion): Collection;

    public function create(
        int $contentRegionId,
        int $contentId,
        string $title,
        bool $isVisible = true,
        int $sort = 0
    ): ContentBox;

    public function update(
        ContentBox $contentBox,
        ?int $contentRegionId = null,
        ?int $contentId = null,
        ?string $title = null,
        ?bool $isVisible = null,
        ?int $sort = null
    ): ContentBox;

    public function delete(ContentBox $contentBox): void;

    public function getAll(): Collection;
}

