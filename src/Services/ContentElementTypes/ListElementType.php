<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\RichEditor;

class ListElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'list';
    }

    public function getLabel(): string
    {
        return __('List');
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
                    'bulletList',
                    'orderedList',
                ]),
        ];
    }
}

