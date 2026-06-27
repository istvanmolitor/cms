<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Override;

class ImageElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'image';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Image');
    }

    public function prepare(array $data): array
    {
        return [
            'src' => isset($data['src']) ? (string) $data['src'] : '',
            'alt' => isset($data['alt']) ? (string) $data['alt'] : '',
            'width' => isset($data['width']) ? (string) $data['width'] : null,
            'height' => isset($data['height']) ? (string) $data['height'] : null,
            'alignment' => isset($data['alignment']) ? (string) $data['alignment'] : 'left',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'src' => 'required|string',
            'alt' => 'nullable|string',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'alignment' => 'string|in:left,center,right',
        ];
    }

    public function settingsToString(array $settings): string
    {
        return (string)$settings['alt'];
    }
}
