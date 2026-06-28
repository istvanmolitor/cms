<?php

declare(strict_types=1);

namespace Molitor\Cms\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Cms\Http\Resources\AuthorResource;
use Molitor\Cms\Models\Author;

class AuthorDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return Author::class;
    }

    protected function getResourceClass(): string
    {
        return AuthorResource::class;
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')
            ->setLabel('Név')
            ->setSearchable()
            ->setOrderable();

        $this->addColumn('email')
            ->setLabel('E-mail')
            ->setSearchable();
    }
}
