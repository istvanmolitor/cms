<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\Textarea;

class ImageElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'image';
    }

    public function getLabel(): string
    {
        return __('Image');
    }

    public function getFormFields(): array
    {
        return [
            Textarea::make('content')
                ->label(__('Image URL'))
                ->required()
                ->rows(2)
                ->columnSpanFull(),
        ];
    }
}

