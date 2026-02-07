<?php
declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentElement;
interface ContentElementRepositoryInterface
{
    public function getById(int $id): ContentElement|null;
    public function getByContentId(int $contentId): Collection;
    public function getByContent(Content $content): Collection;
    public function create(Content $content, string $type, string $data, int $sort = 0, bool $isVisible = true): ContentElement;
    public function update(ContentElement $contentElement, array $data): ContentElement;
    public function delete(ContentElement $contentElement): void;
    public function deleteByContent(Content $content): void;
}
