<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\Textarea;

class CodeElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'code';
    }

    public function getLabel(): string
    {
        return __('Code');
    }

    public function getFormFields(): array
    {
        return [
            Textarea::make('content')
                ->label(__('Code'))
                ->required()
                ->rows(10)
                ->columnSpanFull(),
        ];
    }
}

