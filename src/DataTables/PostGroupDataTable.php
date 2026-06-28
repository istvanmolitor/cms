<?php

declare(strict_types=1);

namespace Molitor\Cms\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Cms\Http\Resources\PostGroupResource;
use Molitor\Cms\Models\PostGroup;

class PostGroupDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return PostGroup::class;
    }

    protected function getResourceClass(): string
    {
        return PostGroupResource::class;
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')
            ->setLabel('Név')
            ->setSearchable()
            ->setOrderable();

        $this->addColumn('lead')
            ->setLabel('Lead')
            ->setSearchable();
    }
}
