<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentElement;

interface ContentElementRepositoryInterface
{
    public function getById(int $id): ?ContentElement;

    public function getByContentId(int $contentId): Collection;

    public function getByContent(Content $content): Collection;

    public function getCountByContent(Content $content): int;

    public function create(Content $content, int $contentElementTypeId, string $settings): ContentElement;

    public function update(ContentElement $contentElement, int $contentElementTypeId, string $settings): ContentElement;

    public function delete(ContentElement $contentElement): void;

    public function deleteByContent(Content $content): void;

    public function deleteWhereSortGreaterOrEqual(Content $content, int $sort): void;
}
