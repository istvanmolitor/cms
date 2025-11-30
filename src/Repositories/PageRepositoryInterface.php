<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Page;

interface PageRepositoryInterface
{
    public function getById(int $id): ?Page;

    public function getBySlug(string $slug): ?Page;

    public function create(string $title, string $slug): Page;

    public function delete(Page $page): void;
}

