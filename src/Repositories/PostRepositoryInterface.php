<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\Post;

interface PostRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Post;

    public function getBySlug(string $slug): ?Post;

    public function existsBySlug(string $slug): bool;

    public function generateUniqueSlug(string $title, string $fallback = 'post'): string;

    public function create(
        string $title,
        string $slug,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null
    ): Post;

    public function update(
        Post $post,
        ?string $title = null,
        ?string $slug = null,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null
    ): Post;

    public function delete(Post $post): void;
}
