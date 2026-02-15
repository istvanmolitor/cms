<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\ContentRegion;

interface ContentRegionRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ContentRegion|null;

    public function getByName(string $name): ContentRegion|null;

    public function create(array $data): ContentRegion;

    public function update(ContentRegion $contentRegion, array $data): ContentRegion;

    public function delete(ContentRegion $contentRegion): void;

    public function approveDraft(ContentRegion $contentRegion): void;
}

