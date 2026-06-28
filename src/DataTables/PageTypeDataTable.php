<?php

declare(strict_types=1);

namespace Molitor\Cms\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Cms\Http\Resources\PageTypeResource;
use Molitor\Cms\Models\PageType;

class PageTypeDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return PageType::class;
    }

    protected function getResourceClass(): string
    {
        return PageTypeResource::class;
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')
            ->setLabel('Név')
            ->setSearchable()
            ->setOrderable();

        $this->addColumn('slug')
            ->setLabel('Slug')
            ->setSearchable();
    }
}
