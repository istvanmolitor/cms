<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class VideoElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'video';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Video');
    }

    public function prepare(array $data): array
    {
        return [
            'url' => $data['url'] ?? '',
            'width' => $data['width'] ?? '300px',
            'height' => $data['height'] ?? '450px',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|string|url',
            'width' => 'nullable|string',
            'height' => 'nullable|string',
        ];
    }
}
