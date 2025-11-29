<?php

namespace Molitor\Cms\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Molitor\Cms\Filament\Resources\PageResource;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    public function getTitle(): string
    {
        return __('Edit Page');
    }
}

