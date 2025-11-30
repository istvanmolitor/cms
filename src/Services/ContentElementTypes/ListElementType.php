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

    public function serialize(array $data): string
    {
        return $data['content'] ?? '';
    }

    public function deserialize(string $content): array
    {
        return ['content' => $content];
    }
}

