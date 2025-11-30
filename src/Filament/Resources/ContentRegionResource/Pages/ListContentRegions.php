<?php

namespace Molitor\Cms\Filament\Resources\ContentRegionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Molitor\Cms\Filament\Resources\ContentRegionResource;

class ListContentRegions extends ListRecords
{
    protected static string $resource = ContentRegionResource::class;

    public function getBreadcrumb(): string
    {
        return __('List');
    }

    public function getTitle(): string
    {
        return __('Content Regions');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('Create Content Region'))
                ->icon('heroicon-o-plus'),
        ];
    }
}

