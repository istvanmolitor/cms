<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\RichEditor;

class QuoteElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'quote';
    }

    public function getLabel(): string
    {
        return __('Quote');
    }

    public function getFormFields(): array
    {
        return [
            RichEditor::make('content')
                ->label(__('Content'))
                ->required()
                ->columnSpanFull()
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'underline',
                    'link',
                ]),
        ];
    }
}

