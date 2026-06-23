<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class IframeElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'iframe';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Iframe');
    }

    public function prepare(array $data): array
    {
        return [
            'url' => $data['url'] ?? '',
            'width' => $data['width'] ?? '100%',
            'height' => $data['height'] ?? '450px',
            'title' => $data['title'] ?? '',
            'allowFullscreen' => $data['allowFullscreen'] ?? true,
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'url' => 'required|string|url',
            'width' => 'nullable|string',
            'height' => 'nullable|string',
            'title' => 'nullable|string',
            'allowFullscreen' => 'boolean',
        ];
    }
}
