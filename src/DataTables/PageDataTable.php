<?php

declare(strict_types=1);

namespace Molitor\Cms\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Cms\Http\Resources\PageResource;
use Molitor\Cms\Models\Page;

class PageDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return Page::class;
    }

    protected function getResourceClass(): string
    {
        return PageResource::class;
    }

    protected function getSearchPlaceholder(): string
    {
        return 'Keresés cím vagy lead alapján...';
    }

    protected function initColumns(): void
    {
        $this->addColumn('title')
            ->setLabel('Cím')
            ->setSearchable()
            ->setOrderable();

        $this->addColumn('lead')
            ->setLabel('Lead')
            ->setSearchable();
    }
}
