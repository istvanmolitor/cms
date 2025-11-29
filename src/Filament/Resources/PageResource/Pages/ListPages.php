<?php

namespace Molitor\Cms\Filament\Resources\PageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Molitor\Cms\Filament\Resources\PageResource;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    public function getBreadcrumb(): string
    {
        return __('List');
    }

    public function getTitle(): string
    {
        return __('Pages');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('Create Page'))
                ->icon('heroicon-o-plus'),
        ];
    }
}

