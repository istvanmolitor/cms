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
        return json_encode([
            'text' => $data['text'] ?? '',
            'level' => $data['level'] ?? 1,
        ]);
    }

    public function deserialize(string $content): array
    {
        $data = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'text' => $content,
                'level' => 1,
            ];
        }
        return $data;
    }

    public function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
            'level' => 'required|integer|min:1|max:6',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.heading';
    }
}

