<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;

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
            TextInput::make('content')
                ->label(__('Content'))
                ->required()
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

