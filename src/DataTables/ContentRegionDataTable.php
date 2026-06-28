<?php

declare(strict_types=1);

namespace Molitor\Cms\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Cms\Http\Resources\ContentRegionResource;
use Molitor\Cms\Models\ContentRegion;

class ContentRegionDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return ContentRegion::class;
    }

    protected function getResourceClass(): string
    {
        return ContentRegionResource::class;
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')
            ->setSearchable()
            ->setOrderable();
    }
}
