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

    public function serialize(array $data): string
    {
        return $data['content'] ?? '';
    }

    public function deserialize(string $content): array
    {
        return ['content' => $content];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.heading';
    }
}

