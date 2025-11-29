<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\Page;

interface PageRepositoryInterface
{
    public function getById(int $id): ?Page;

    public function getBySlug(string $slug): ?Page;

    public function getByContentId(int $contentId): ?Page;

    public function getByContent(Content $content): ?Page;

    public function create(string $title, string $slug, int $contentId): Page;

    public function update(Page $page, array $data): Page;

    public function delete(Page $page): void;

    public function getAll(): Collection;

    public function getAllByTitle(): Collection;
}

