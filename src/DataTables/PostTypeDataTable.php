<?php

declare(strict_types=1);

namespace Molitor\Cms\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Cms\Http\Resources\PostTypeResource;
use Molitor\Cms\Models\PostType;

class PostTypeDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return PostType::class;
    }

    protected function getResourceClass(): string
    {
        return PostTypeResource::class;
    }

    protected function getSearchPlaceholder(): string
    {
        return 'Keresés név vagy slug alapján...';
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')
            ->setLabel('Név')
            ->setSearchable()
            ->setOrderable();

        $this->addColumn('slug')
            ->setLabel('Slug')
            ->setSearchable()
            ->setOrderable();

        $this->addColumn('created_at')
            ->setLabel('Létrehozva')
            ->setOrderable();
    }
}
