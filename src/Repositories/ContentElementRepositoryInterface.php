<?php
}
    public function getByType(string $type): Collection;

    public function delete(ContentElement $contentElement): void;

    public function update(ContentElement $contentElement, array $data): ContentElement;

    public function create(int $contentId, string $type, string $content): ContentElement;

    public function getByContent(Content $content): Collection;

    public function getByContentId(int $contentId): Collection;

    public function getById(int $id): ?ContentElement;
{
interface ContentElementRepositoryInterface

use Molitor\Cms\Models\ContentElement;
use Molitor\Cms\Models\Content;
use Illuminate\Database\Eloquent\Collection;

namespace Molitor\Cms\Repositories;

declare(strict_types=1);


