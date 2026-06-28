<?php

declare(strict_types=1);

namespace Molitor\Cms\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Cms\Http\Resources\MenuResource;
use Molitor\Cms\Models\Menu;

class MenuDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return Menu::class;
    }

    protected function getResourceClass(): string
    {
        return MenuResource::class;
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')
            ->setSearchable()
            ->setOrderable();
    }
}
