<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\ContentElementType;

interface ContentElementTypeRepositoryInterface
{
    public function getById(int $id): ?ContentElementType;
    public function getByType(string $type): ?ContentElementType;

    public function getAll(): Collection;
}
