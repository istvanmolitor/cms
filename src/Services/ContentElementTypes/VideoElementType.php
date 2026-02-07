<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\TextInput;

class VideoElementType extends BaseContentElementType
{
    public function getType(): string
    {
        return 'video';
    }

    public function getLabel(): string
    {
        return __('Video');
    }

    public function getFormFields(): array
    {
        return [
            TextInput::make('url')
                ->label(__('YouTube URL'))
                ->required()
                ->columnSpanFull(),
            TextInput::make('width')
                ->label(__('Szélesség'))
                ->default('300px'),
            TextInput::make('height')
                ->label(__('Magasság'))
                ->default('450px'),
        ];
    }

    public function serialize(array $data): string
    {
        return json_encode([
            'url' => $data['url'] ?? '',
            'width' => $data['width'] ?? '300px',
            'height' => $data['height'] ?? '450px',
        ]);
    }

    public function deserialize(string $content): array
    {
        $data = json_decode($content, true);

        return [
            'url' => $data['url'] ?? $content,
            'width' => $data['width'] ?? '300px',
            'height' => $data['height'] ?? '450px',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|string',
            'width' => 'required|string',
            'height' => 'required|string',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.video';
    }
}

