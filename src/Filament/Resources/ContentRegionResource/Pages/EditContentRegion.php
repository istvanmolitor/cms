<?php

namespace Molitor\Cms\Filament\Resources\ContentRegionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Molitor\Cms\Filament\Resources\ContentRegionResource;

class EditContentRegion extends EditRecord
{
    protected static string $resource = ContentRegionResource::class;

    public function getTitle(): string
    {
        return __('Edit Content Region');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

