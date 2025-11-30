<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\RichEditor;

class HeadingElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'heading';
    }

    public function getLabel(): string
    {
        return __('Heading');
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
                    'h2',
                    'h3',
                ]),
        ];
    }
}

