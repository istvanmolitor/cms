<?php

namespace Molitor\Cms\Filament\Resources\MenuResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Molitor\Cms\Filament\Resources\MenuResource;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}

