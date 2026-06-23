<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class CodeElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'code';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Code');
    }

    public function prepare(array $data): array
    {
        return [
            'code' => $data['code'] ?? '',
            'language' => $data['language'] ?? 'javascript',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'code' => 'required|string',
            'language' => 'nullable|string',
        ];
    }
}
