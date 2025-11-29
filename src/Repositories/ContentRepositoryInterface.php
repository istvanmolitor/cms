<?php
declare(strict_types=1);
namespace Molitor\Cms\Repositories;
use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\User\Models\User;
interface ContentRepositoryInterface
{
    public function getById(int $id): ?Content;
    public function getByUserId(int $userId): Collection;
    public function getByUser(User $user): Collection;
    public function create(int $userId): Content;
    public function delete(Content $content): void;
    public function getAll(): Collection;
}
