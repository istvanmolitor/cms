<?php
}
    public function getAllByTitle(): Collection;

    public function getAll(): Collection;

    public function delete(Page $page): void;

    public function update(Page $page, array $data): Page;

    public function create(string $title, string $slug, int $contentId): Page;

    public function getByContent(Content $content): ?Page;

    public function getByContentId(int $contentId): ?Page;

    public function getBySlug(string $slug): ?Page;

    public function getById(int $id): ?Page;
{
interface PageRepositoryInterface

use Molitor\Cms\Models\Page;
use Molitor\Cms\Models\Content;
use Illuminate\Database\Eloquent\Collection;

namespace Molitor\Cms\Repositories;

declare(strict_types=1);


