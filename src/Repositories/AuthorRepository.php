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

    public function getAll(): Collection
    {
        return $this->author->all();
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
