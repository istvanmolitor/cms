<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\Page;

interface PageRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Page;

    public function getBySlug(string $slug): ?Page;

    public function existsBySlug(string $slug): bool;

    public function generateUniqueSlug(string $title, string $fallback = 'page'): string;

    public function create(
        string $title,
        string $slug,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null
    ): Page;

    public function update(
        Page $page,
        ?string $title = null,
        ?string $slug = null,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null
    ): Page;

    public function delete(Page $page): void;
}
