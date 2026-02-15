<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\ContentElementType;

interface ContentElementTypeRepositoryInterface
{
    public function getById(int $id): ?ContentElementType;
    public function getByName(string $name): ?ContentElementType;

    public function getAll(): Collection;

    public function getIdByName(string $name): ?int;
}
