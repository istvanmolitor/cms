<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function __construct(
        private Author $author
    ) {}

    public function getAll(array $params = []): mixed
    {
        $query = $this->author->query();

        if (isset($params['search']) && $params['search']) {
            $query->where(function ($q) use ($params) {
                $q->where('name', 'like', "%{$params['search']}%")
                    ->orWhere('email', 'like', "%{$params['search']}%");
            });
        }

        if (isset($params['sort']) && $params['sort']) {
            $direction = $params['direction'] ?? 'asc';
            $query->orderBy($params['sort'], $direction);
        } else {
            $query->orderBy('name', 'asc');
        }

        if (isset($params['paginate']) && $params['paginate']) {
            return $query->paginate((int) ($params['per_page'] ?? 10));
        }

        return $query->get();
    }

    public function getById(int $id): ?Author
    {
        return $this->author->find($id);
    }

    public function create(array $data): Author
    {
        return $this->author->create($data);
    }

    public function update(Author $author, array $data): Author
    {
        $author->update($data);

        return $author;
    }

    public function delete(Author $author): void
    {
        $author->delete();
    }
}
