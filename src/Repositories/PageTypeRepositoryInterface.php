<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\PageType;

interface PageTypeRepositoryInterface
{
    public function getAll(): Collection;

    public function getDefault(): ?PageType;

    public function getById(int $id): ?PageType;

    public function getBySlug(string $slug): ?PageType;

    public function create(array $data): PageType;

    public function update(PageType $pageType, array $data): PageType;

    public function delete(PageType $pageType): void;
}
