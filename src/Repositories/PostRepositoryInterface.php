<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Post;
use Molitor\Keyword\Models\Keyword;

interface PostRepositoryInterface
{
    public function getAll(array $params = []): mixed;

    public function getByKeyword(Keyword $keyword, array $params = []): mixed;

    public function getLatest(int $limit): mixed;

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
        ?int $languageId = null,
        ?int $postTypeId = null
    ): Post;

    public function update(
        Post $post,
        ?string $title = null,
        ?string $slug = null,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null,
        ?int $postTypeId = null
    ): Post;

    public function delete(Post $post): void;

    public function toString(Post $post): string;
}
