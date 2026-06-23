<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class HeadingElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'heading';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Heading');
    }

    public function prepare(array $data): array
    {
        return [
            'text' => $data['text'] ?? '',
            'level' => $data['level'] ?? 1,
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'text' => 'required|string',
            'level' => 'required|integer|min:1|max:6',
        ];
    }
}
