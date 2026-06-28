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

    protected function getSearchPlaceholder(): string
    {
        return 'Keresés cím vagy lead alapján...';
    }

    protected function initColumns(): void
    {
        $this->addColumn('main_image_url')
            ->setLabel('Fő kép');

        $this->addColumn('title')
            ->setLabel('Cím')
            ->setSearchable()
            ->setOrderable();

        $this->addColumn('lead')
            ->setLabel('Lead')
            ->setSearchable()
            ->setOrderable();

        $this->addColumn('postGroups')
            ->setLabel('Csoportok');
    }

    public function query(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->with('postGroups');
    }
}
