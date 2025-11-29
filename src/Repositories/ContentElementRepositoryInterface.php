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
    public function create(int $contentId, string $type, string $content): ContentElement;
    public function update(ContentElement $contentElement, array $data): ContentElement;
    public function delete(ContentElement $contentElement): void;
    public function getByType(string $type): Collection;
}
