<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\RichEditor;

class TextElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'text';
    }

    public function getLabel(): string
    {
        return __('Text');
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
                    'h2',
                    'h3',
                ]),
        ];
    }

    public function serialize(array $data): string
    {
        return $data['content'] ?? '';
    }

    public function deserialize(string $content): array
    {
        return ['content' => $content];
    }
}

