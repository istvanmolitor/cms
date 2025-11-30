<?php

namespace Molitor\Cms\Filament\Resources\MenuItemResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Molitor\Cms\Filament\Resources\MenuItemResource;

class EditMenuItem extends EditRecord
{
    protected static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}

