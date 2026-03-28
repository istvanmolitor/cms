<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Molitor\Cms\Models\Content;

interface ContentRepositoryInterface
{
    public function getById(int $id): ?Content;

    public function create(): Content;

    public function delete(Content $content): void;
}
