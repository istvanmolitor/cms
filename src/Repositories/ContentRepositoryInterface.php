<?php
}
    public function getAll(): Collection;

    public function delete(Content $content): void;

    public function create(int $userId): Content;

    public function getByUser(User $user): Collection;

    public function getByUserId(int $userId): Collection;

    public function getById(int $id): ?Content;
{
interface ContentRepositoryInterface

use Molitor\User\Models\User;
use Molitor\Cms\Models\Content;
use Illuminate\Database\Eloquent\Collection;

namespace Molitor\Cms\Repositories;

declare(strict_types=1);


