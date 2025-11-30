<?php

namespace Molitor\Cms\Filament\Resources\MenuResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Molitor\Cms\Filament\Resources\MenuResource;

class EditMenu extends EditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}

