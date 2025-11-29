<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\ContentRegion;

interface ContentRegionRepositoryInterface
{
    public function getById(int $id): ?ContentRegion;

    public function getByName(string $name): ?ContentRegion;

    public function create(string $name): ContentRegion;

    public function update(ContentRegion $contentRegion, string $name): ContentRegion;

    public function delete(ContentRegion $contentRegion): void;

    public function getAll(): Collection;
}

