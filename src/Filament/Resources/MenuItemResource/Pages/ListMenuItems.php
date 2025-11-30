<?php

namespace Molitor\Cms\Filament\Resources\MenuItemResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Molitor\Cms\Filament\Resources\MenuItemResource;

class ListMenuItems extends ListRecords
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}

