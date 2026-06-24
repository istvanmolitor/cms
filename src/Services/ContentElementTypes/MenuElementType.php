<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class MenuElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'menu';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Menü');
    }

    public function prepare(array $data): array
    {
        return [
            'name' => $data['name'] ?? '',
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
