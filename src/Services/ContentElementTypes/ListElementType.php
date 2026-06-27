<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ListElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'list';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('List');
    }

    public function prepare(array $data): array
    {
        return [
            'items' => $data['items'] ?? [],
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'items' => 'required|array',
        ];
    }

    public function settingsToString(array $settings): string
    {
        return $this->arrayToString($settings['items']);
    }
}
