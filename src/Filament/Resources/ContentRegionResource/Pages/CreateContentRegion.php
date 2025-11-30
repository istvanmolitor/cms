<?php

namespace Molitor\Cms\Filament\Resources\ContentRegionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Molitor\Cms\Filament\Resources\ContentRegionResource;

class CreateContentRegion extends CreateRecord
{
    protected static string $resource = ContentRegionResource::class;

    public function getTitle(): string
    {
        return __('Create Content Region');
    }
}

