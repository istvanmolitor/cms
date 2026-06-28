<?php

declare(strict_types=1);

namespace Molitor\Cms\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Cms\Http\Resources\PostResource;
use Molitor\Cms\Models\Post;

class PostDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return Post::class;
    }

    protected function getResourceClass(): string
    {
        return PostResource::class;
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
