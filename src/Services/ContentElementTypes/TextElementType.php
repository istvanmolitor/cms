<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Override;

class TextElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'text';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Text');
    }

    public function prepare(array $data): array
    {
        return [
            'text' => $data['text'] ?? '',
            'align' => $data['align'] ?? 'left',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
            'align' => 'required|string|in:left,center,right,justify',
        ];
    }
}
