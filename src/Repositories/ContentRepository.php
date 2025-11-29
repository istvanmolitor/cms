<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Molitor\Cms\Models\Content;
use Molitor\User\Models\User;

class ContentRepository implements ContentRepositoryInterface
{
    public function __construct(
        private Content $content
    ) {
    }

    public function getById(int $id): ?Content
    {
        return $this->content->find($id);
    }

    public function getByUserId(int $userId): Collection
    {
        return $this->content->where('user_id', $userId)->get();
    }

    public function getByUser(User $user): Collection
    {
        return $this->getByUserId($user->id);
    }

    public function create(int $userId): Content
    {
        return $this->content->create([
            'user_id' => $userId,
        ]);
    }

    public function delete(Content $content): void
    {
        // Delete related content elements
        $content->contentElements()->delete();

        // Delete the content
        $content->delete();
    }

    public function getAll(): Collection
    {
        return $this->content->orderBy('created_at', 'desc')->get();
    }
}

