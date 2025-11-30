<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Filament\Forms\Components\Textarea;

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
            Textarea::make('content')
                ->label(__('Video URL'))
                ->required()
                ->rows(2)
                ->columnSpanFull(),
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

