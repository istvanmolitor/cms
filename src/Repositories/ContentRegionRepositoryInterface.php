<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\ContentRegion;

interface ContentRegionRepositoryInterface
{
    public function getById(int $id): ContentRegion|null;

    public function getByName(string $name): ContentRegion|null;

    public function create(string $name): ContentRegion;

    public function delete(ContentRegion $contentRegion): void;
}

